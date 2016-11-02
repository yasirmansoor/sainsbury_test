<?php

namespace YasirMansoor\UnitTests;
use YasirMansoor\Commands\CommandParser;

class MockCommandParser extends CommandParser {

    /**
     * @param array $data
     */
    public function getRenderedOutput(array $data) {
        return $this->renderOutput($data);
    }

}