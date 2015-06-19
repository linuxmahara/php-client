<?php

// # Get Wallet Sample
//
// This sample code demonstrate how you can get a wallet, as documented here at:
// <a href="http://dev.blockcypher.com/#wallet_api">http://dev.blockcypher.com/#wallet_api</a>
// API used: GET /v1/btc/main/wallets/Wallet-Name

// ## Get Wallet Name.
// In samples we are using CreateWallet.php sample to get the created instance of wallet.
// You have to run that sample before running this one or there will be no wallets

require __DIR__ . '/../bootstrap.php';

// Wallet must be created
if (isset($_GET['wallet_name'])) {
    $walletName = filter_input(INPUT_GET, 'wallet_name', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
    $walletName = 'alice'; // Default wallet name for samples
}

// ### Get Wallet
try {
    $output = \BlockCypher\Api\Wallet::get($walletName, array(), $apiContexts['BTC.main']);
} catch (Exception $ex) {
    ResultPrinter::printError("Get a Wallet", "Wallet", null, $walletName, $ex);
    exit(1);
}

ResultPrinter::printResult("Get a Wallet", "Wallet", $output->getName(), null, $output);

return $output;
