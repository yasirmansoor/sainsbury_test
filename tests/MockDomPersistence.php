<?php

namespace YasirMansoor\UnitTests;

use YasirMansoor\Libraries\DomPersistenceInterface;


class MockDomPersistence implements DomPersistenceInterface {

    public $nodes = [];

    /**
     * @param $url
     * @return mixed
     */
    public function process($url) {
        return true;
    }

    /**
     * @param          $xpath
     * @param \DOMText $data
     * @return mixed
     */
    public function getNodeElementValue($xpath, \DOMText $data) {

    }

    /**
     * @param          $xpath
     * @param \DOMText $data
     * @return mixed
     */
    public function getNodeElement($xpath, \DOMText $data) {

    }

    /**
     * @param $xpath
     * @return mixed
     */
    public function getNodes($xpath) {
        $nodes =[];
        foreach ($this->nodes as $node) {
            $nodes[] = $this->convertToMockNodeElement($node);
        }
        return $nodes;
    }

    private function convertToMockNodeElement($data) {
        $node = new \stdClass();
        $node->nodeValue = $data;
        return $node;
    }

    /**
     * @return mixed
     */
    public function isEmpty() {
        return false;
    }

    /**
     * @return mixed
     */
    public function getFileSize() {
        return 100;
    }
}