<?php

namespace YasirMansoor\Libraries;

trait Formatting {

    /**
     * @param string $message
     */
    public function outputMessage($message) {
        if (is_array($message)) {
            print_r($message);
            echo PHP_EOL;
        } else {
            echo $message . PHP_EOL;
        }
    }

    public function outputJson($data) {
        if (! is_array($data)) {
            $data = (array) $data;
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * @param $url
     * @return string
     */
    public function prepUrl($url) {
        if  ($schema = parse_url($url)) {
            if (! isset($schema["scheme"])) {
                $url = "http://{$url}";
            }
        }
        return $url;
    }

    /**
     * @param $input
     * @return mixed|string
     */
    public function cleanseCurrency($input) {
        $value = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $value = number_format((float) $value, 2, '.', '');
        return $value;
    }

    /**
     * @param     $bytes
     * @param int $dec
     * @return string
     */
    public function humanFilesize($bytes, $dec = 2) {
        $size   = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
    
    
}