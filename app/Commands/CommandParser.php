<?php

namespace YasirMansoor\Commands;

use YasirMansoor\Libraries\ParserMaster;
use YasirMansoor\Libraries\DomPersistence;

class CommandParser extends CommandAbstract {

    /**
     * @param array $params
     * @return bool
     */
    public function urlCommand(array $params) {
        //check if all obligatory params are present
        if (! $this->checkForObligatoryParams($params, ['url'])) {
            return false;
        }

        //get data
        $parser = new ParserMaster($params['url'], new DomPersistence());
        $data = $parser->process()->getResults();

        if (count($data)) {
            $this->renderOutput($data);
            return true;
        } else {
            $message = 'Nothing could be scraped from this URL : ' . $params['url'];
            $this->outputJson($message);
            return false;
        }
    }

    /**
     * @param array $data
     */
    protected function renderOutput(array $data) {
        $output = [];
        $total = 0;
        foreach ($data as $product) {
            $output['results'][] = (array) $product;
            $total += $product->unitPrice;
        }
        $output['total'] = $this->cleanseCurrency($total);
        $this->outputJson($output);
    }


}