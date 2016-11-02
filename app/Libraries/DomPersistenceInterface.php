<?php
namespace YasirMansoor\Libraries;

interface DomPersistenceInterface {

    /**
     * @param $url
     * @return mixed
     */
    public function process($url);

    /**
     * @param          $xpath
     * @param \DOMText $data
     * @return mixed
     */
    public function getNodeElementValue($xpath, \DOMText $data);

    /**
     * @param          $xpath
     * @param \DOMText $data
     * @return mixed
     */
    public function getNodeElement($xpath, \DOMText $data);

    /**
     * @param $xpath
     * @return mixed
     */
    public function getNodes($xpath);

    /**
     * @return mixed
     */
    public function isEmpty();

    /**
     * @return mixed
     */
    public function getFileSize();
}