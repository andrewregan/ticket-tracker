## Summary
Host a site to allow users to reserve tickets for an event.  Collect phone numbers, email, name, and number of tickets from a user.

## Setup

This site is best hosted on a linux-based operating system.  Download a free copy of [Ubuntu](http://www.ubuntu.com/), and host it yourself or use [DigitalOcean](https://m.do.co/c/435dd313bb6a) to host your site.

##### Install Apache, PHP, and MySQL
``` bash
sudo apt-get install apache2 php5 php5-mysql mysql-server
```

##### Install Git and download the site
``` bash
sudo apt-get git

cd /var/www

sudo git clone https://github.com/andrewregan/ticket-tracker.git ticket-tracker

sudo chgrp www-data ticket-tracker -R
```

##### Install this site configuration
Add a new Apache configuration file `/etc/apache2/sites-available/ticket-tracker.conf`.
```
<VirtualHost *:80>
    ServerName yourserver.com
    DocumentRoot /var/www/ticket-tracker/public_html
</VirtualHost>
```

##### Enable the new configuration
``` bash
sudo a2ensite ticket-tracker.conf
sudo systemctl restart apache2.service
```

##### Install and run composer
``` bash
sudo apt-get install curl php5-cli git

curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

cd /var/www/ticket-tracker/

sudo composer update

sudo chgrp www-data . -R
```

##### Finish the site setup
Visit the new website and finish the setup via the web interface.

-----
## Style Guide and Coding Conventions
This project follows the following style and coding guidelines.

### HTML

- [W3 Schools](http://www.w3schools.com/html/html5_syntax.asp)
- [Code Guide by @mdo](http://codeguide.co/#html-attribute-order)

##### Summary

- Use 2 spaces in HTML files
- Do not use single line `<div />` endings

##### HTML Tag Order

- `class`
- `id, name`
- `data-*`
- `src, for, type, href, value`
- `title, alt`
- `role, aria-*`

##### Example

``` html
<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticket Tracker Setup</title>

    <!-- CSS dependencies -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container" id="mainContent" name="mainContent" data-example="hello" alt="..." placeholder="nothing">
      <p>Hello, world!</p>
      <br>
    </div>
  </body>
</html>
```

### CSS

- [Code Guide by @mdo](http://codeguide.co/#css-declaration-order)

### JavaScript

- [W3 Schools](http://www.w3schools.com/js/js_conventions.asp)

### PHP

- [PHP FIG](http://www.php-fig.org/psr/psr-2/)

##### Summary

- Use 4 spaces in PHP files
- Do not the include ending `?>` tag in PHP-only files
- Opening braces go on separate line for `functions`, `classes`, and `methods`.
- Opening braces go on same line for control structures like `if`, `switch`,
  `for`, `while`.

##### Example

``` php
<?php
namespace Vendor\Package;

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class Foo extends Bar implements FooInterface
{
    public function sampleFunction($a, $b = null)
    {
        if ($a === $b) {
            bar();
        } elseif ($a > $b) {
            $foo->bar($arg1);
        } else {
            BazClass::bar($arg2, $arg3);
        }
    }

    final public static function bar()
    {
        // method body
    }
}
```
