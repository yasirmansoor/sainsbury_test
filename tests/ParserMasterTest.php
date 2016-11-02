<?php

namespace YasirMansoor\UnitTests;

use YasirMansoor\Libraries\DomPersistence;
use YasirMansoor\Libraries\ParserMaster;

class ParserMasterTest extends \PHPUnit_Framework_TestCase {

    private $url;

    public function setUp() {
        $config = new Config();
        $this->url = $config->workingUrl;
    }

    /**
     * @return array
     */
    public function addDataProviderParentProductsUrls() {
        $config = new Config();
        return $config->mainUrls;
    }

    /**
     * @dataProvider addDataProviderParentProductsUrls
     * @param string $url
     * @param bool $expected
     */
    public function testProductUrlsParsed($url, $expected) {
        $parser = new ParserMaster($url, new DomPersistence());
        $result = $parser->process()->getResults();

        if ($expected) {
            $this->assertNotEmpty($result);
        } else {
            $this->assertEmpty($result);
        }
    }
    public function testProductUrlsParsedWithMockupDom() {
        //create mock DomPersistence with working products urls
        $config = new Config();
        $mockDomPersistence = new MockDomPersistence();
        $mockDomPersistence->nodes = $this->prepNodesData($config->productUrls);

        $parser = new ParserMaster('www.placeholder.com', $mockDomPersistence);
        $result = $parser->process()->getResults();

        //check if parsed products count is correct
        $this->assertEquals(count($mockDomPersistence->nodes), count($result));
        return $result;
    }

    /**
     * @depends testProductUrlsParsedWithMockupDom
     * @param array $products
     */
    public function testProductsDataCorrectlyParsed(array $products) {
        $config = new Config();
        for($counter = 0; $counter < count($config->productUrls); $counter++) {
            //should this URL return valid product data
            if ($config->productUrls[$counter][1]) {
                //check product title is not empty
                $this->assertNotNull($products[$counter]->title, 'Product should not be empty');

            } else {
                //check product title is empty
                $this->assertNull($products[$counter]->title, 'Product should be empty');
            }
        }
        return $products;
    }

     public function testProductsPricesCheck() {

         $parser = new MockParserMaster('www.placeholder.com', new MockDomPersistence());
         $products = $parser->process()->getResults();

         $command = new MockCommandParser();
         $command->getRenderedOutput($products);
         $jsonData = ob_get_contents();
         $data = json_decode($jsonData, true);

        //calculate expected total
        $total = 0;
        foreach($data['results'] as $product) {
            $total += $product['unitPrice'];
        }
        $this->assertEquals($total, $data['total']);
    }

    /**
     * @param array $data
     * @return array
     */
    private function prepNodesData(array $data) {
        $result = [];
        foreach($data as $item) {
            $result[] = $item[0];
        }
        return $result;
    }

    public function testSuppressedOutput() {
        // Suppress  output to console
        $this->setOutputCallback(function() {});
        print '*';
        $this->assertFalse(false, "Don't see the *");
    }


}