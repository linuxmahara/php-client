<?php

namespace BlockCypher\Crypto;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Crypto\EcAdapter\EcAdapterInterface;
use BitWasp\Bitcoin\Crypto\Random\Rfc6979;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use BitWasp\Bitcoin\Key\PrivateKeyInterface;
use BitWasp\Buffertools\Buffer;

/**
 * Class Signer
 * @package BlockCypher\Crypto
 */
class Signer
{
    /**
     * Sign hex data deterministically using deterministic k.
     *
     * @param string $hexDataToSign
     * @param PrivateKeyInterface|string $privateKey
     * @return string
     */
    public static function sign($hexDataToSign, $privateKey)
    {
        if (is_string($privateKey)) {
            // privateKey is hex string -> convert to object
            $privateKey = self::fromHexPrivateKey($privateKey);
        }

        // Convert hex data to buffer
        $data = Buffer::hex($hexDataToSign);

        /** @var EcAdapterInterface $ecAdapter */
        $ecAdapter = Bitcoin::getEcAdapter();

        // Deterministic digital signature generation
        $k = new Rfc6979($ecAdapter, $privateKey, $data, 'sha256');

        $sig = $ecAdapter->sign($data, $privateKey, $k);

        // DEBUG
        //echo "hexDataToSign: <br/>";
        //var_dump($hexDataToSign);
        //echo "sig: <br/>";
        //var_dump($sig->getHex());

        return $sig->getHex();
    }

    /**
     * @param string $hexPrivateKey
     * @return PrivateKeyInterface
     * @throws \Exception
     */
    public static function fromHexPrivateKey($hexPrivateKey)
    {
        $ecAdapter = Bitcoin::getEcAdapter();

        // Import from compressed private key
        $compressed = true;
        $privateKey = PrivateKeyFactory::fromHex($hexPrivateKey, $compressed, $ecAdapter);

        return $privateKey;
    }
}