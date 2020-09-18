# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stonkeep/clicksign.svg?style=flat-square)](https://packagist.org/packages/stonkeep/clicksign)
[![Build Status](https://img.shields.io/travis/stonkeep/clicksign/master.svg?style=flat-square)](https://travis-ci.org/stonkeep/clicksign)
[![Quality Score](https://img.shields.io/scrutinizer/g/stonkeep/clicksign.svg?style=flat-square)](https://scrutinizer-ci.com/g/stonkeep/clicksign)
[![Total Downloads](https://img.shields.io/packagist/dt/stonkeep/clicksign.svg?style=flat-square)](https://packagist.org/packages/stonkeep/clicksign)

Laravel package for integration with ClickSign services

## Installation

You can install the package via composer:

```bash
composer require stonkeep/clicksign
```

fill in the required variables
```bash
CLICKSIGN_ACCESS_TOKEN=
CLICKSIGN_DEV_MODE=true
CLICKSIGN_DEV_URL=https://sandbox.clicksign.com
CLICKSIGN_PROD_URL=https://app.clicksign.com
```

## Usage

#### To create a document
``` php
$response = (new Clicksign())->createDocument($path, $clicksignPath = null, $mimetype = 'application/pdf', $deadline = null, $autoClose = true, $locale = 'pt-BR', $sequence_enabled = false);
```

#### To create a signer
``` php
$response = (new Clicksign())->createSigner(String $email, String $name, $phoneNumber = null, $documentation = false, $birthday = null, $has_documentation = false);
```

#### To add a signer to the document
``` php
$response =  (new Clicksign())->signerToDocument(String $document_key, $signer_key, $sign_as = 'approve', $message = null);
```
#### to view a document
``` php
$response =  (new Clicksign())->visualizaDocumento($DocumentKey);
```
#### To Cancel Document
``` php
$response = (new Clicksign())->cancelDocument($DocumentKey);
```
#### To Delete Document
``` php
$response = (new Clicksign())->deleteDocument($DocumentKey);
```
#### To Notify Signer By Email
``` php
$response = (new Clicksign())->notificationsByEmail($signer_key, $message = null);
```


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email mateusgalasso@yahoo.com.br instead of using the issue tracker.

## Credits

- [Mateus Galasso](https://github.com/stonkeep)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
