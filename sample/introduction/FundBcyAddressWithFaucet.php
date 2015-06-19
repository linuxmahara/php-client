<?php

// Run on console:
// php -f .\sample\introduction\FundBcyAddressWithFaucet.php

require __DIR__ . '/../bootstrap.php';

use BlockCypher\Api\Faucet;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Rest\ApiContext;

$apiContext = ApiContext::create(
    'test', 'bcy', 'v1',
    new SimpleTokenCredential('c0afcccdde5081d6429de37d16166ead'),
    array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
);

$faucet = new Faucet();
$faucet->setAddress('CFqoZmZ3ePwK5wnkhxJjJAQKJ82C7RJdmd');
$faucet->setAmount(100000);

$faucetResponse = $faucet->turnOn($apiContext);

ResultPrinter::printResult("Fund Address With Faucet", "FaucetResponse", $faucet->getAddress(), null, $faucetResponse);