<?php

namespace YasirMansoor\UnitTests;

use YasirMansoor\Libraries\ParserProduct;
use YasirMansoor\Models\Product;

class MockParserProduct extends ParserProduct {

    private $product;

    /**
     * @param Product $product
     */
    public function setProduct(Product $product) {
        $this->product = $product;
    }

    /**
     * @return $this
     */
    public function process() {
        $product = new Product();
        $product->title = $this->generateRandomString();
        $product->size = $this->generateRandomDecimal();
        $product->unitPrice = $this->generateRandomDecimal();
        $product->description = $this->generateRandomString();
        $this->results = $product;
        return $this;
    }

    /**
     * @return string
     */
    private function generateRandomString() {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,10))),1,10);
    }

    /**
     * @return float|int
     */
    private function generateRandomDecimal() {
        $min = 1;
        $max = 1000;
        return mt_rand ($min * 10, $max * 10) / 10;
    }

}