#Sainsbury web scraper test
Author: Yasir Mansoor
Email: yasir.mansoor.uk@googlemail.com

##Installation
1. Clone to your local directory
2. Navigate to this directory.
2. Run ```compser update```

##Instructions
1. Navigate to your installation directory.
2. Run the following from a command line (this doesn't work through a browser):
```
php command.php parser:url  <your_url>
```

Replace ```<your_url>``` with your test URL.

```
\\Example (using test URL)
php command.php parser:url http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html
```

The json response will be returned.

##Unit testing
1. Navigate to your installation directory
2. Run ```phpunit``` to run all tests.
3. Main tests configuration is set in ```tests/Config.php```