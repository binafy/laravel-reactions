# Laravel Reactions

<img src="https://banners.beyondco.de/Laravel%20Reactions.png?theme=dark&packageManager=composer+require&packageName=binafy%2Flaravel-reactions&pattern=bathroomFloor&style=style_2&description=Flexible+emoji+reactions+for+Laravel&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Binafy Laravel Reactions">

[![PHP Version Require](https://img.shields.io/packagist/dependency-v/binafy/laravel-reactions/php)](https://packagist.org/packages/binafy/laravel-reactions)
[![Latest Stable Version](https://img.shields.io/packagist/v/binafy/laravel-reactions.svg?style=flat-square)](https://packagist.org/packages/binafy/laravel-reactions)
[![Total Downloads](https://img.shields.io/packagist/dt/binafy/laravel-reactions.svg?style=flat-square)](https://packagist.org/packages/binafy/laravel-reactions)
[![License](https://img.shields.io/packagist/l/binafy/laravel-reactions)](https://packagist.org/packages/binafy/laravel-reactions)
[![Passed Tests](https://github.com/binafy/laravel-reactions/actions/workflows/tests.yml/badge.svg)](https://github.com/binafy/laravel-reactions/actions/workflows/tests.yml)
[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/binafy/laravel-reactions)

## Introduction

Laravel Reactions is a simple and flexible package that allows you to add reaction functionality (like 👍, ❤️, 😂, etc.) to any Eloquent model in your Laravel application. Whether you're building a social network, blog, or forum, this package makes it easy to let users express themselves through customizable reactions.

🔧 Features:

- Add reactions to any model (e.g., posts, comments, messages)
- Multiple reaction types (like, love, laugh, etc.)
- Easy API for adding/removing reactions
- Track who reacted and how
- Eloquent relationships for seamless integration
- Built-in support for custom reaction types
- Lightweight and easy to customize

## Installation

- ```PHP >= 8.1```
- ```Laravel >= 10.0```

You can install the package with Composer:

```bash
composer require binafy/laravel-reactions
```

## Publish

If you want to publish a config file you can use this command:

```shell
php artisan vendor:publish --tag="laravel-reactions-config"
```

If you want to publish the migrations you can use this command:

```shell
php artisan vendor:publish --tag="laravel-reactions-migrations"
```

For convenience, you can use this command to publish config, migration, and ... files:

```shell
php artisan vendor:publish --provider="Binafy\LaravelReaction\Providers\LaravelReactionServiceProvider"
```

## License

The MIT License (MIT). Please see [License File](https://github.com/binafy/laravel-reactions/blob/1.x/LICENSE) for more information.

## Star History

[![Star History Chart](https://api.star-history.com/svg?repos=binafy/laravel-reactions&type=Date)](https://star-history.com/#binafy/laravel-reactions&Date)

## Donate

If this package is helpful for you, you can buy a coffee for me :) ❤️

- Iranian Gateway: https://daramet.com/milwad_khosravi
- Paypal Gateway: SOON
- MetaMask Address: `0xf208a562c5a93DEf8450b656c3dbc1d0a53BDE58`
