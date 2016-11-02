<?php

namespace YasirMansoor\UnitTests;

class Config {

    //working URL to use
    public $workingUrl = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';

    //Working param to use for main controller
    public $workingParam = 'parser:url';

    //params to test main controller (second param dictates expected result success/failure)
    public $commandParams = [

        ['nonExistentCommmand:nonExistentAction', false],
        ['parser:nonExistentAction', false],
        ['parser:url', true],

    ];

    //URLs to test parent products list page (second param dictates expected result success/failure)
    public $mainUrls = [

        ['http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html', true],
        ['hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html',true],
        ['https://www.google.co.uk/', false],
        ['www.tesco.com', false],
        ['thiswillnotwork', false],

    ];

    //URLs to test child product pages (second param dictates expected result success/failure)
    public $productUrls = [

        ['http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-apricot-ripe---ready-320g.html', true],
        ['http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/sainsburys-avocado-xl-pinkerton-loose-300g.html', true],
        ['http://google.co.uk', false],
        ['http://www.bbc.co.uk', false],

    ];

}