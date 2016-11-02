<?php

namespace YasirMansoor\Libraries;

use YasirMansoor\Models\Product;

class ParserProduct extends ParserAbstract {

    protected $xPaths = [  'main' => '//div[contains(@class, "productSummary")]',
                           'title' => '//div[contains(@class, "productTitleDescriptionContainer")]',
                           'unitPrice' => '//p[contains(@class, "pricePerUnit")]',
                           'description' => '//*[@id="information"]/productcontent/htmlcontent/div[1]'
                         ];

    public function process() {
        $product = new Product();
        $nodes = parent::process();
        if ($nodes->length) {
            $child = $nodes->item(0)->childNodes->item(0);

            $product->title = $this->domPersistence->getNodeElementValue($this->xPaths['title'], $child);
            $product->unitPrice = $this->cleanseCurrency($this->domPersistence->getNodeElementValue($this->xPaths['unitPrice'], $child));
            $product->description = $this->domPersistence->getNodeElementValue($this->xPaths['description'], $child);
            $product->size =  $this->humanFilesize($this->domPersistence->getFileSize());
        }
        $this->results = $product;
        return $this;
    }

}

