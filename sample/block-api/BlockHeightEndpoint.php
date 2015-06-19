<?php

// Run on console:
// php -f .\sample\block-api\BlockHeightEndpoint.php

require __DIR__ . '/../bootstrap.php';

use BlockCypher\Api\Block;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Rest\ApiContext;

$apiContext = ApiContext::create(
    'main', 'btc', 'v1',
    new SimpleTokenCredential('c0afcccdde5081d6429de37d16166ead'),
    array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
);

$params = array(
    'txstart' => 1,
    'limit' => 1,
);

$block = Block::get('293000', $params, $apiContext);

ResultPrinter::printResult("Get Block With Paging", "Block", $block->getHash(), null, $block);