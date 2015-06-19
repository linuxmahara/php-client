<?php

// # Create Bitcoin Testnet Address Sample
// This sample code demonstrate how you can create
// an address.

require __DIR__ . '/../bootstrap.php';

$addressKeyChain = null;

// For Sample Purposes Only.
$request = null;

try {
    // ### Create Btc Testnet Address
    // Create an address by calling the Address::create() method
    // with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
    $addressKeyChain = \BlockCypher\Api\Address::create(null, $apiContexts['BTC.test3']);
} catch (Exception $ex) {
    ResultPrinter::printError("Create Btc Testnet Address", "AddressKeyChain", null, $request, $ex);
    exit(1);
}

ResultPrinter::printResult("Create Btc Testnet Address", "AddressKeyChain", $addressKeyChain->getAddress(), $request, $addressKeyChain);

return $addressKeyChain;