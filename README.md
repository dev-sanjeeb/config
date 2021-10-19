## Introduction

This project is focused around writing a parser for configuration files.

Supported file formats:

- JSON

## Requirements

- PHP >= 7.2

## Install with Composer

``` bash
$ composer require dev-sanjeeb/config
```

## Usage

### Loading Files
Method 1: At the time of initialization
```php
// Loading Single file
$config = new Config(__DIR__.'/files/test.json');

// Loading Multiple file
$config = new Config([__DIR__.'/files/test.json', __DIR__.'/files/test2.json']);
```

Method 2: After initialization
```php
$config = new Config();

// Loading Single file
$config->loadFiles(__DIR__.'/files/test.json');

// Loading Multiple file
$config->loadFiles([__DIR__.'/files/test.json', __DIR__.'/files/test2.json']);
```

### Loading Raw Text

```php
$config = new Config();

// Loading Raw Text
$config->loadRawText(
            [
                [
                    'content' => '{"a":1,"b":2,"c":3,"d":4,"e":5}',
                    'type' => 'json'
                ],
                [
                    'content' => '{"a1":1,"b1":2,"c1":3,"d1":4,"e1":5}',
                    'type' => 'json'
                ]
            ]
        );
```

### Getter

```php
$config = new Config();

// Accessing 
$config->get('database.host');

// Accessing with default data
$config->get('database.host', '127.0.0.1');
```

### Setter

```php
$config = new Config();

// Setting value
$config->set('database.host', '127.0.0.1');
```

### Merge Array

```php
$config = new Config();

// Setting value
$config->merge(['database' => ['host'] => '127.0.0.1']);
```

### Reset

```php
$config = new Config();

// Setting value
$config->set();
```


## Testing

``` bash
$ phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
