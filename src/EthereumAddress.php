<?php declare(strict_types=1);

namespace doxadoxa\phpethaddress;

use doxadoxa\phpethaddress\exceptions\EthereumAddressException;
use kornrunner\Keccak;
use Mdanter\Ecc\Crypto\Key\PrivateKeyInterface;

class EthereumAddress
{
    private $privateKey;
    private $publicKey;

    /**
     * EthereumAddress constructor.
     * @param PrivateKeyInterface $privateKey
     * @param bool $test
     * @throws EthereumAddressException
     */
    public function __construct(PrivateKeyInterface $privateKey)
    {
        $this->privateKey = $privateKey;
        try {
            $this->publicKey = $this->makePublicKey($privateKey);
        } catch (\Exception $e) {
            throw new EthereumAddressException("Public key hash convertation exception.");
        }
    }

    /**
     * @param string $privateKey
     * @return string
     * @throws \Exception
     */
    private function makePublicKey(PrivateKeyInterface $privateKey):string
    {
        $publicKey = $privateKey->getPublicKey();
        $publicKeyHex = gmp_strval($publicKey->getPoint()->getX(), 16) . gmp_strval($publicKey->getPoint()->getY(), 16);
        $hash = Keccak::hash(hex2bin($publicKeyHex), 256, true);
        return "0x" . bin2hex(substr($hash,-20));
    }

    public function publicKey():string
    {
        return $this->publicKey;
    }

    public function privateKey():string
    {
        return gmp_strval($this->privateKey->getSecret(),16);
    }
}
