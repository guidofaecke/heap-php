# Heap PHP Client
PHP library for sending data through Heap API.

## Installation
Minimum PHP 7.4

You can install it using Composer:
```
composer require guidofaecke/heap-php
```

## Track Events
```php
$heap = new \Heap\Client('APP_ID');
$heap->track('Paid Order', 'example@example.com');
```
[See full example](examples/track-event.php)

## Add User Properties
```php
$heap = new \Heap\Client('APP_ID');
$heap->addUserProperties('example@example.com', array(
    'profession' => 'Scientist',
));
```
[See full example](examples/add-user-properties.php)
