<?php

namespace YasirMansoor\Controllers;
use YasirMansoor\Libraries\CommandMapper;

class MainController {

    use \YasirMansoor\Libraries\Formatting;

    /**
     * Router constructor.
     * @param array $controller
     */
    public function __construct(array $controller) {

        return $this->mapCommand($controller);
    }

    /**
     * @param array $controller
     * @return bool
     */
    protected function mapCommand(array $controller) {
        $commandMapper = new CommandMapper();

        //was a command passed in (format is object:method)
        $commandMapper->command = isset($controller[1]) ? $controller[1] : null;
        if (! $commandMapper->command || ! (strpos($commandMapper->command, ':') !== false)) {
            $this->outputJson('No command was specified.');
            return false;
        }

        //get object type and action
        list($commandMapper->type, $commandMapper->method) = explode(':', $commandMapper->command);
        $commandMapper->class = 'YasirMansoor\Commands\Command' . ucfirst($commandMapper->type);
        $commandMapper->method = $commandMapper->underscoresToCamelCase($commandMapper->method) . 'Command';

        //check if class and method exist
        if (method_exists($commandMapper->class, $commandMapper->method) &&
            is_callable([$commandMapper->class, $commandMapper->method]))
        {
            //check URL param was passed in
            if (! isset($controller[2])) {
                $this->outputJson(' URL parameter was not supplied.');
                return false;
            }
            $commandMapper->params = ['url' => $controller[2]];

            $object = new $commandMapper->class();
            $method = $commandMapper->method;
            return $object->$method($commandMapper->params);
        } else {
            $this->outputJson(" '$commandMapper->command' command does not exist.");
            return false;
        }
    }


}