<?php

namespace YasirMansoor\Commands;

abstract class CommandAbstract {

    use \YasirMansoor\Libraries\Formatting;

    /**
     * @param array $params
     * @param array $required
     * @return bool
     */
    protected function checkForObligatoryParams(array $params, array $required) {

        $result = (count(array_intersect_key(array_flip($required), $params)) === count($required));
        if (! $result) {
            $output = 'One or more obligatory params are missing (' . implode(', ', $required) .
                ' required).';
            $this->outputJson($output);
        }
        return $result;
    }
}