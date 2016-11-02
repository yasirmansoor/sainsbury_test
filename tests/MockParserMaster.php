<?php

namespace YasirMansoor\UnitTests;
use YasirMansoor\Libraries\ParserMaster;

class MockParserMaster extends ParserMaster{

    public function process() {
        for($counter = 0; $counter < 10; $counter++) {
            $parserProduct = new MockParserProduct($this->url, new MockDomPersistence());
            $this->results[]  = $parserProduct->process()->getResults();
        }
        return $this;
    }
}