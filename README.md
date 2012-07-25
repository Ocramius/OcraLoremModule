# OcraLoremModule - Lorem Ipsum Generator for ZF2

## Installation

 1.  Add `"ocramius/ocra-lorem-module": "dev-master"` to your `composer.json`
 2.  Run `php composer.phar install`
 3.  Enable the module in your `config/application.config.php` by adding `OcraLoremModule` to `modules`

## Usage

In your view scripts, simply write following

```php
<?php
echo $this->lorem();
````
