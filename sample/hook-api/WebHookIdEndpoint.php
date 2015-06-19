<?php

// Run on console:
// php -f .\sample\hook-api\WebHookIdEndpoint.php

require __DIR__ . '/../bootstrap.php';

use BlockCypher\Api\WebHook;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Rest\ApiContext;

$apiContext = ApiContext::create(
    'main', 'btc', 'v1',
    new SimpleTokenCredential('c0afcccdde5081d6429de37d16166ead'),
    array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
);

$webHook = WebHook::get('d5ca3bd3-5dfb-477d-9fb4-ac3510af258d', array(), $apiContext);

ResultPrinter::printResult("WebHook ID Endpoint", "WebHook", $webHook->getId(), null, $webHook);