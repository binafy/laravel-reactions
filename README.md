# Laravel Reactions

<img src="https://banners.beyondco.de/Laravel%20Reactions.png?theme=dark&packageManager=composer+require&packageName=binafy%2Flaravel-reactions&pattern=bathroomFloor&style=style_2&description=Flexible+emoji+reactions+for+Laravel&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Binafy Laravel Reactions">

[![PHP Version Require](https://img.shields.io/packagist/dependency-v/binafy/laravel-reactions/php)](https://packagist.org/packages/binafy/laravel-reactions)
[![Latest Stable Version](https://img.shields.io/packagist/v/binafy/laravel-reactions.svg?style=flat-square)](https://packagist.org/packages/binafy/laravel-reactions)
[![Total Downloads](https://img.shields.io/packagist/dt/binafy/laravel-reactions.svg?style=flat-square)](https://packagist.org/packages/binafy/laravel-reactions)
[![License](https://img.shields.io/packagist/l/binafy/laravel-reactions)](https://packagist.org/packages/binafy/laravel-reactions)
[![Passed Tests](https://github.com/binafy/laravel-reactions/actions/workflows/tests.yml/badge.svg)](https://github.com/binafy/laravel-reactions/actions/workflows/tests.yml)
[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/binafy/laravel-reactions)

## Introduction

Laravel Reactions is a simple and flexible package that enables you to add reaction functionality (such as 👍, ❤️, 😂, etc.) to any Eloquent model in your Laravel application. Whether you're building a social network, blog, or forum, this package makes it easy for users to express themselves through customizable reactions.

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

If you want to publish a config file, you can use this command:

```shell
php artisan vendor:publish --tag="laravel-reactions-config"
```

If you want to publish the migrations, you can use this command:

```shell
php artisan vendor:publish --tag="laravel-reactions-migrations"
```

For convenience, you can use this command to publish config, migration, and ... files:

```shell
php artisan vendor:publish --provider="Binafy\LaravelReaction\Providers\LaravelReactionServiceProvider"
```

## Usage

### Setting Up Your Models

Before using reactions, your models need the appropriate traits. User models require the Reactor trait to create reactions, while content models require the Reactable trait to receive reactions.

#### User Model Setup

```php
use Binafy\LaravelReaction\Traits\Reactor;

class User extends Authenticatable
{
    use Reactor;
}
```

#### Content Model Setup

```php
use Binafy\LaravelReaction\Contracts\HasReaction;
use Binafy\LaravelReaction\Traits\Reactable;

class Post extends Model implements HasReaction
{
    use Reactable;
}
```

### Creating Reactions

There are multiple ways to create reactions depending on your application's needs. You can create reactions from the user perspective or from the reactable content perspective.

#### From User Models

Users can react to any reactable content using the `reaction()` method from the `Reactor` trait:

```php
use Binafy\LaravelReaction\Enums\LaravelReactionTypeEnum;

$user = User::find(1);
$post = Post::find(1);

// Using enum reaction types
$user->reaction(LaravelReactionTypeEnum::REACTION_ANGRY, $post);

// Using custom string reaction types
$user->reaction('love', $post);
```

#### From Reactable Models

Reactable content can also initiate reactions, which is useful when you want to handle reactions from the content's perspective:

```php
$post = Post::find(1);
$user = User::find(1);

// Specify the user explicitly
$post->reaction('like', $user);

// Use the currently authenticated user
$post->reaction('like'); // Uses auth()->user()
```

### Checking Reactions

You can check whether content has been reacted to by specific users using the `isReacted()` method:

```php
$post = Post::find(1);
$user = User::find(1);

// Check if a specific user reacted
if ($post->isReacted($user)) {
    echo "User has reacted to this post";
}

// Check if the currently authenticated user reacted
if ($post->isReacted()) {
    echo "You have reacted to this post";
}
```

### Basic Reaction Queries

The `Reactable` trait provides several methods for querying reaction data:

#### Counting Reactions by Type

```php
$post = Post::find(1);

// Count specific reaction type
$likeCount = $post->getReactCountByType('like');
$angryCount = $post->getReactCountByType(LaravelReactionTypeEnum::REACTION_ANGRY);
```

#### Getting All Reaction Counts

```php
$post = Post::find(1);

// Returns collection with type => count pairs
$reactionCounts = $post->getReactionsWithCount();
// Example result: ['like' => 5, 'love' => 3, 'angry' => 1]
```

#### Getting Reactors

```php
$post = Post::find(1);

// Get all users who reacted to this post
$reactors = $post->getReactors();
```

### Removing Reactions

Reactions can be removed either by type or completely:

#### Remove Specific Reaction Type

```php
$user = User::find(1);
$post = Post::find(1);

// Remove specific reaction type
$user->removeReaction('like', $post);

// Or from the reactable side
$post->removeReaction('like', $user);
$post->removeReaction('like'); // For authenticated user
```

#### Remove All Reactions

```php
$user = User::find(1);
$post = Post::find(1);

// Remove all reactions by the user on this post
$user->removeReactions($post);

// Or from the reactable side
$post->removeReactions($user);
$post->removeReactions(); // For authenticated user
```

### Events

| Event                    | Description               |
|--------------------------|---------------------------|
| `StoreReactionEvent`     | When store new reaction   |
| `RemoveReactionEvent`    | When remove a reaction    |
| `RemoveAllReactionEvent` | When remove all reactions |

## Contributors

Thanks to all the people who contributed. [Contributors](https://github.com/binafy/laravel-reactions/graphs/contributors).

<a href="https://github.com/binafy/laravel-reactions/graphs/contributors"><img src="https://opencollective.com/laravel-reactions/contributors.svg?width=890&button=false" /></a>

## Security

If you discover any security-related issues, please email `binafy23@gmail.com` instead of using the issue tracker.

## Changelog

The changelog can be found in the `CHANGELOG.md` file of the GitHub repository.

## License

The MIT License (MIT). Please see [License File](https://github.com/binafy/laravel-reactions/blob/1.x/LICENSE) for more information.

## Star History

[![Star History Chart](https://api.star-history.com/svg?repos=binafy/laravel-reactions&type=Date)](https://star-history.com/#binafy/laravel-reactions&Date)

## Donate

If this package is helpful for you, you can buy a coffee for me :) ❤️

- Iranian Gateway: https://daramet.com/milwad_khosravi
- Paypal Gateway: SOON
- MetaMask Address: `0xf208a562c5a93DEf8450b656c3dbc1d0a53BDE58`
