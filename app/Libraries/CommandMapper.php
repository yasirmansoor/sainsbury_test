<?php

namespace YasirMansoor\Libraries;

class CommandMapper {

        public $command;

        public $type;

        public $method;

        public $class;

        public $params = [];

    /**
     * @param string $string
     * @return mixed
     */
    public function underscoresToCamelCase($string) {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        $str[0] = strtolower($str[0]);
        return $str;
    }
}