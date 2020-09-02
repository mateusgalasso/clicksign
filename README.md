# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stonkeep/clicksign.svg?style=flat-square)](https://packagist.org/packages/stonkeep/clicksign)
[![Build Status](https://img.shields.io/travis/stonkeep/clicksign/master.svg?style=flat-square)](https://travis-ci.org/stonkeep/clicksign)
[![Quality Score](https://img.shields.io/scrutinizer/g/stonkeep/clicksign.svg?style=flat-square)](https://scrutinizer-ci.com/g/stonkeep/clicksign)
[![Total Downloads](https://img.shields.io/packagist/dt/stonkeep/clicksign.svg?style=flat-square)](https://packagist.org/packages/stonkeep/clicksign)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require stonkeep/clicksign
```

fill in the required variables
```bash
CLICKSIGN_ACCESS_TOKEN=
CLICKSIGN_DEV_MODE=true
```

## Usage

#### To create a document
``` php
$response = (new Clicksign())->createDocument($path, $clicksignPath = null, $mimetype = 'application/pdf', $deadline = null, $autoClose = true, $locale = 'pt-BR', $sequence_enabled = false);
```

#### To create a signer
``` php
$response = (new Clicksign())->createSigner($email, $name, $phoneNumber = null, $documentation = false, $birthday = null, $has_documentation = false);
```

#### To add a signer to the document
``` php
$response =  (new Clicksign())->signerToDocument($DocumentKey, $signerKey);
```
#### to view a document
``` php
$response =  (new Clicksign())->visualizaDocumento($DocumentKey);
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
