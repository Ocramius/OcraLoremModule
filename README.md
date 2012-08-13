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
// 10000 lorem!
echo $this->lorem(10000);
````


[LoremPixel](http://lorempixel.com/) is also supported:

```php
<?php
echo $this->loremPixel();
```

Will produce something like

```html
<img src="http://lorempixel.com/640/480/" alt="Lorem Pixel"/>
```

```php
<?php
echo $this->loremPixel(300, 200, false, 'sports', 'Dummy Text', 2);
```

Will produce something like

![Dummy Text](http://lorempixel.com/300/100/sports/2/Dummy%20Text/)