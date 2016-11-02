<?php

namespace YasirMansoor\Libraries;

interface ParserInterface {

    /**
     * ParserInterface constructor.
     * @param                         $url
     * @param DomPersistenceInterface $domPersistence
     */
    public function __construct($url, DomPersistenceInterface $domPersistence);

    /**
     * @return mixed
     */
    public function process();

    /**
     * @return mixed
     */
    public function getResults();

}