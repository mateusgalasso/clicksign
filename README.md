# Laravel package for integration with ClickSign services

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mateusgalasso/clicksign.svg?style=flat-square)](https://packagist.org/packages/mateusgalasso/clicksign)
[![Build Status](https://img.shields.io/travis/mateusgalasso/clicksign/master.svg?style=flat-square)](https://travis-ci.org/mateusgalasso/clicksign)
[![Total Downloads](https://img.shields.io/packagist/dt/mateusgalasso/clicksign.svg?style=flat-square)](https://packagist.org/packages/mateusgalasso/clicksign)

Laravel package for integration with ClickSign services

## Installation

You can install the package via composer:

```bash
composer require mateusgalasso/clicksign
```

fill in the required variables
```bash
CLICKSIGN_ACCESS_TOKEN=
CLICKSIGN_DEV_MODE=true //In production it must be false to get the clicksign production path
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

- [Mateus Galasso](https://github.com/mateusgalasso)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
