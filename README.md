phpethaddress
===
Library to generating Ethereum address from PHP.

Dependencies:
* phpecc
* keccak

##Getting started
You can install package via composer:
```bash
composer require doxadoxa/phpethaddress
```

##How to use
To generate address with random private key.
```php
$address = EthereumAddressGenerator::generate();
```

To generate address with exists private key.
```php
$address = EthereumAddressGenerator::generate();
```

Accessing to private key and address (return as HEX-string):
```php
$address->privateKey();
$address->publicKey();
```

##Tests
To run tests use:
```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```