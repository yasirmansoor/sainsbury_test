<?php

namespace YasirMansoor\Libraries;

class DomPersistence implements DomPersistenceInterface {

    protected $fileSize;
    protected $finder;
    protected $data;

    /**
     * @param $url
     * @return bool
     */
    public function process($url) {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        $this->data = curl_exec($curlHandle);
        $this->fileSize = curl_getinfo($curlHandle, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        curl_close($curlHandle);
        return (bool) $this->data;
    }

    /**
     * @param          $xpath
     * @param \DOMText $data
     * @return null|string
     */
    public function getNodeElementValue($xpath, \DOMText $data) {
        $node = $this->getNodeElement($xpath, $data);
        if ($node) {
            return trim($node->nodeValue);
        } else {
            return null;
        }
    }

    /**
     * @param          $xpath
     * @param \DOMText $data
     * @return null
     */
    public function getNodeElement($xpath, \DOMText $data) {
        $result = $this->finder->query($xpath, $data);
        if ($result) {
            return $result->item(0);
        } else {
            return null;
        }
    }

    /**
     * @param $xpath
     * @return \DOMNodeList
     */
    public function getNodes($xpath) {
        $dom = new \DOMDocument();
        @$dom->loadHTML($this->data);
        $this->finder = new \DomXPath($dom);
        return  $this->finder->query($xpath);
    }

    /**
     * @return bool
     */
    public function isEmpty() {
        return (! $this->data);
    }

    /**
     * @return mixed
     */
    public function getFileSize() {
        return $this->fileSize;
    }

}