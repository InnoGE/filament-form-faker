# Filament Form Faker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/innoge/filament-form-faker.svg?style=flat-square)](https://packagist.org/packages/innoge/filament-form-faker)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/innoge/filament-form-faker/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/innoge/filament-form-faker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/innoge/filament-form-faker/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/innoge/filament-form-faker/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/innoge/filament-form-faker.svg?style=flat-square)](https://packagist.org/packages/innoge/filament-form-faker)

The Filament Form Faker is a utility package designed for generating fake input data in Filament v3 forms. It's ideal
for
streamlining the development of extensive forms and conducting thorough form testing.

> [!NOTE]
> This package is not recommended for production use and should be limited to development and testing scenarios.

This package is currently in its Beta phase. Your participation in testing and feedback through issue reporting is
highly appreciated.

## Installation

You can install the package via composer:

```bash
composer require innoge/filament-form-faker --dev
```

## Filament Panel Usage

To autofill forms with fake data in Filament Record Pages, use
the `InnoGE\FilamentFormFaker\Traits\FillsFormWithFakeData` trait. Below is an example for
the CreateUser of the UserResource page:

```php
<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use InnoGE\FilamentFormFaker\Traits\FillsFormWithFakeData;

class CreateUser extends CreateRecord
{
    use FillsFormWithFakeData;

    protected static string $resource = UserResource::class;
}
```

By default, forms are filled with fake data only in local or testing environments. This behavior can be customized by
overriding the `shouldFillFormWithFakeData` method in your Page Component.

```php
protected function shouldFillFormWithFakeData(): bool
{
    // insert your custom logic here
}

```

## Standalone Usage

When you are using `Filament/Forms`outside of the Panel Builder you can use the `fake()` method on your Form instance to
fill your form with fake data. We recommend using this method in your `mount` method.

```php
public function mount()
{
    $this->getForm('form')->fake();
    // or
    $this->form->fake();
}
```

### Supported Field Types

Currently, we support the following field types:

- Builder
- Checkbox
- CheckboxList
- KeyValue
- Option
- Repeater
- Select
- Textarea
- TextInput

If you want to add support for other field types please create an issue or a pull request.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tim Geisendoerfer](https://github.com/geisi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
