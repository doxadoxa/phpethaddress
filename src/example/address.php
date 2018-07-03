<?php

require "../../vendor/autoload.php";

use doxadoxa\phpethaddress\EthereumAddressGenerator;

$address = EthereumAddressGenerator::generate();
echo sprintf("public: %s\nprivate: %s\n", $address->publicKey(), $address->privateKey());
