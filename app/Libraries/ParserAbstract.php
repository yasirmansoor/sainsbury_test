<?php

namespace YasirMansoor\Libraries;

abstract class ParserAbstract implements ParserInterface {

    use \YasirMansoor\Libraries\Formatting;

    protected $url;
    protected $xPaths = [];
    protected $results = [];
    protected $domPersistence;

    /**
     * ParserAbstract constructor.
     * @param                         $url
     * @param DomPersistenceInterface $domPersistence
     */
    public function __construct($url, DomPersistenceInterface $domPersistence) {
        //check if URL is valid
        $url = $this->prepUrl($url);
        if (! $this->isUrlValid($url)) {
           $message = 'URL is not valid: ' . $url;
           $this->outputJson($message);
            return false;
        }
        $this->url = $this->prepUrl($url);
        $this->domPersistence = $domPersistence;
    }

    /**
     * @return bool|mixed
     */
    public function process() {
        $this->results = [];
        if (! $this->domPersistence->process($this->url)) {
            $message = 'Nothing could be scraped from this URL : ' . $this->url;
            $this->outputJson($message);
            return false;
        }

        if (! $this->xPaths['main']) {
            $message = 'xPaths has not been set for ' . get_class($this);
            $this->outputJson($message);
            return false;
        }
        return $this->domPersistence->getNodes($this->xPaths['main']);
    }

    /**
     * @return array
     */
    public function getResults() {
        return $this->results;
    }

    /**
     * @param $url
     * @return bool
     */
    protected function isUrlValid($url) {
        return (! filter_var($url, FILTER_VALIDATE_URL) === FALSE);
    }

}