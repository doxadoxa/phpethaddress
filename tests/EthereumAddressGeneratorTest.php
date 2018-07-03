<?php
declare(strict_types=1);

use doxadoxa\phpethaddress\EthereumAddress;
use doxadoxa\phpethaddress\EthereumAddressGenerator;

class EthereumAddressGeneratorTest extends \PHPUnit\Framework\TestCase
{
    private function data()
    {
        return [
            'private' => '83a204862b3d2fe854c3141eab5db676a93f8e6909bb05ae4ef33e48bddbc0f',
            'address' => '0xa14cae004ff1a523bb77b7ee26f019fcd60fc317'
        ];
    }

    public function testAddressObjectIsRight()
    {
        $address = EthereumAddressGenerator::generate();
        $this->assertInstanceOf(EthereumAddress::class, $address, "Generator return not EthereumAddress object.");
    }

    public function testPrivateKeyNotNull()
    {
        $address = EthereumAddressGenerator::generate();
        $this->assertNotNull($address->privateKey(), "Private key is null.");
    }

    public function testPublicKeyNotNull()
    {
        $address = EthereumAddressGenerator::generate();
        $this->assertNotNull($address->publicKey(), "Public key is null.");
    }

    public function testAddressObjectIsRightOnPrivateKeySetted()
    {
        $address = EthereumAddressGenerator::generate($this->data()['private']);
        $this->assertInstanceOf(EthereumAddress::class, $address, "Generator return not EthereumAddress object.");
    }

    public function testAddressObjectHasCorrectAddress()
    {
        $address = EthereumAddressGenerator::generate($this->data()['private']);
        $this->assertSame($this->data()['address'], $address->publicKey());
    }
}
