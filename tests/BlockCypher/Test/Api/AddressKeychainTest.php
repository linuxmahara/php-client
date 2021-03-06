<?php

namespace BlockCypher\Test\Api;

use BlockCypher\Api\AddressKeyChain;

/**
 * Class AddressKeyChainTest
 *
 * @package BlockCypher\Test\Api
 */
class AddressKeyChainTest extends ResourceModelTestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return AddressKeyChain
     */
    public static function getObject()
    {
        return new AddressKeyChain(self::getJson());
    }

    /**
     * Gets Json String of Object AddressKeyChain
     * @return string
     */
    public static function getJson()
    {
        /*
        {
            "private": "bf442658d87e2fa590aca663b9f2bbff4fd19cac690941e6225b4eee3c6318d1",
            "public": "028043b74cddd7e25c8ad27794927f245cf7f8a9c2d08ffb9fb5e5776c03febaa1",
            "address": "15vah7EL1kekvR56Y1pA4gDp7PETR5wUud",
            "wif": "L3dWP9XFYznfeoDRabcUGDddcJrvauuMqx5bpSpoH7QgKiGe1PLq",
            "error": "",
            "errors": []
        }
        */

        return '{"private":"bf442658d87e2fa590aca663b9f2bbff4fd19cac690941e6225b4eee3c6318d1","public":"028043b74cddd7e25c8ad27794927f245cf7f8a9c2d08ffb9fb5e5776c03febaa1","address":"15vah7EL1kekvR56Y1pA4gDp7PETR5wUud","wif":"L3dWP9XFYznfeoDRabcUGDddcJrvauuMqx5bpSpoH7QgKiGe1PLq","error":"","errors":[]}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return AddressKeyChain
     */
    public function testSerializationDeserialization()
    {
        $obj = new AddressKeyChain(self::getJson());

        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getPrivate());
        $this->assertNotNull($obj->getPublic());
        $this->assertNotNull($obj->getAddress());
        $this->assertNotNull($obj->getWif());

        $this->assertEquals(self::getJson(), $obj->toJson());

        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param AddressKeyChain $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getPrivate(), "bf442658d87e2fa590aca663b9f2bbff4fd19cac690941e6225b4eee3c6318d1");
        $this->assertEquals($obj->getPublic(), "028043b74cddd7e25c8ad27794927f245cf7f8a9c2d08ffb9fb5e5776c03febaa1");
        $this->assertEquals($obj->getAddress(), "15vah7EL1kekvR56Y1pA4gDp7PETR5wUud");
        $this->assertEquals($obj->getWif(), "L3dWP9XFYznfeoDRabcUGDddcJrvauuMqx5bpSpoH7QgKiGe1PLq");
    }
}
