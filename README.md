# DriveWell is a Laravel Domain Driven Design Package 🚗
DriveWell is a Laravel Package that will help you build and maintain a high level Domain Driven Design application

- Create DDD Laravel Application
- Author: Amine Bouhaddi 

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/DriveWell.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/DriveWell)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require bouhaddi/drivewell
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="drivewell-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="drivewell-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="drivewell-views"
```

## Usage

```php
$driveWell = new Bouhaddi\DriveWell();
echo $driveWell->echoPhrase('Hello, Bouhaddi!');
```

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

- [Amine Bouhaddi](https://github.com/Bouhaddi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
