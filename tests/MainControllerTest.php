<?php

namespace YasirMansoor\UnitTests;

use YasirMansoor\Controllers\MainController;

class MainControllerTest extends \PHPUnit_Framework_TestCase {

    private $data = [];


    /**
     *
     */
    public function setUp() {
        $this->data[] = 'command.php';
    }

    /**
     * @return array
     */
    public function addDataProviderCommandParams() {
        $config = new Config();
        return $config->commandParams;
    }

    /**
     * @dataProvider addDataProviderCommandParams
     * @param string $param
     * @param bool $expected
     */
    public function testCommandParams($param, $expected) {
        $data = $this->data;
        $data[] = $param;
        $controller = new MainController($data);

        if ($expected) {
            $this->expectOutputRegex('/URL parameter was not supplied./');
        } else {
            $this->expectOutputRegex('/command does not exist./');
        }
    }

    /**
     * @depends testCommandParams
     */
    public function testUrlParamIsNotDetected() {
        $data = $this->buildParams();
        $controller = new MainController($data);
        $this->expectOutputRegex('/URL parameter was not supplied./');
    }

    /**
     * @depends testCommandParams
     */
    public function testUrlParamIsDetected() {
        $data = $this->buildParams();
        $data[] = 'https://www.google.co.uk/';
        $controller = new MainController($data);
        $this->expectOutputRegex('/Nothing could be scraped from this URL/');
    }

    /**
     * @return array
     */
    private function buildParams() {
        $config = new Config();
        $data = $this->data;
        $data[] = $config->workingParam;
        return $data;
    }
}