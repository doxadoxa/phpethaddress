<?php declare(strict_types=1);

namespace doxadoxa\phpethaddress;

use Mdanter\Ecc\EccFactory;

class EthereumAddressGenerator
{
    /**
     * @var EthereumAddressGenerator
     */
    static private $instance;

    private function __construct()
    {
        //
    }

    /**
     * @param string|null $privateKey
     * @param bool $test
     * @return EthereumAddress
     * @throws exceptions\EthereumAddressException
     */
    static public function generate(string $privateKey = null):EthereumAddress
    {
        if (!static::$instance) {
            static::$instance = new EthereumAddressGenerator();
        }

        return static::$instance->generateAddress($privateKey);

    }

    /**
     * @param string $privateKey
     * @param bool $test
     * @return EthereumAddress
     * @throws exceptions\EthereumAddressException
     */
    public function generateAddress(string $privateKey = null): EthereumAddress
    {
        $adapter = EccFactory::getAdapter();
        $generator = EccFactory::getSecgCurves($adapter)->generator256k1();

        if($privateKey) {
            $privateKey = $generator->getPrivateKeyFrom(gmp_init($privateKey, 16));
        } else {
            $privateKey = $generator->createPrivateKey();
        }

        return new EthereumAddress($privateKey);
    }
}
