<?php

namespace BlockCypher\Crypto;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;

/**
 * Class PrivateKeyList
 * @package BlockCypher\Crypto
 */
class PrivateKeyList
{
    /**
     * @var PrivateKey[]
     */
    private $keys;

    /**
     * @param PrivateKey[] $keys
     */
    function __construct($keys = null)
    {
        $this->keys = $keys;
    }

    /**
     * @param string[] $hexPrivateKeys
     * @param string
     * @return PrivateKeyList
     */
    public static function fromHexPrivateKeyArray($hexPrivateKeys, $coinSymbol)
    {
        $network = CoinSymbolNetworkMapping::getNetwork($coinSymbol);
        $ecAdapter = Bitcoin::getEcAdapter();

        $privateKeyList = array();
        foreach ($hexPrivateKeys as $hexPrivateKey) {

            // Import from compressed private key
            $compressed = true;
            $privateKey = PrivateKeyFactory::fromHex($hexPrivateKey, $compressed, $ecAdapter);

            // Get address (used as array key)
            $publicKey = $privateKey->getPublicKey();
            $address = $publicKey->getAddress()->getAddress($network);

            $privateKeyList[$address] = $privateKey;
        }

        return new self($privateKeyList);
    }

    /**
     * Append Key to the list.
     *
     * @param string $key
     * @param string $address
     * @return $this
     * @throws \Exception
     */
    public function addKey($key, $address = null)
    {
        if ($address === null) {
            $this->keys[] = $key;
        } else {
            if (isset($this->keys[$address])) {
                throw new \Exception("Key $address already in use.");
            } else {
                $this->keys[$address] = $key;
            }
        }
    }

    /**
     * @param string $address
     * @throws \Exception
     */
    public function deleteKey($address)
    {
        if (isset($this->keys[$address])) {
            unset($this->keys[$address]);
        } else {
            throw new \Exception("Invalid address $address.");
        }
    }

    /**
     * @param string $address
     * @return PrivateKey
     * @throws \Exception
     */
    public function getKey($address)
    {
        if (isset($this->keys[$address])) {
            return $this->keys[$address];
        } else {
            throw new \Exception("Address $address not found in PrivateKeyList.");
        }
    }

    /**
     * @param string $address
     * @return bool
     */
    public function keyExists($address)
    {
        return isset($this->keys[$address]);
    }

    /**
     * @return string[]
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * @return string[]
     */
    public function addresses()
    {
        return array_keys($this->keys);
    }

    /**
     * @return int
     */
    public function length()
    {
        return count($this->keys);
    }
}
