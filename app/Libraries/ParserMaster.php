<?php

namespace YasirMansoor\Libraries;

class ParserMaster extends ParserAbstract {

    protected $xPaths = ['main' => '//div[contains(@class, "productInfo")]/h3//@href'];
    private $urls = [];

    public function process() {
        //get each product anchor URL
        $nodes =  parent::process();
        if ($nodes) {
            foreach ($nodes as $node) {
                $this->urls[] =  $node->nodeValue;
            }

            //parse each product URL and get results
            if (count($this->urls)) {
                foreach($this->urls as $url) {
                    $parserProduct = new ParserProduct($url, new DomPersistence());
                    $this->results[]  = $parserProduct->process()->getResults();
                }
            }
        }
        return $this;
    }

}