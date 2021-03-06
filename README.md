# PHP Router

[![Latest Stable Version](https://poser.pugx.org/schoenbeck/phprouter/v/stable)](https://packagist.org/packages/schoenbeck/phprouter)
[![License](https://poser.pugx.org/schoenbeck/phprouter/license)](//packagist.org/packages/schoenbeck/phprouter)

<!--# Authors

- [Lukas220300](https://github.com/Lukas220300) -->

# Easy to install with **composer**

```sh
$ composer require schoenbeck/phprouter
```

## Usage

### Friendly URL

Create a simple .htaccess file on your root directory if you're using Apache with mod_rewrite enabled.

```apache
Options +FollowSymLinks
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ /index.php [L,QSA]
```

This is a simple example of routers in action

```php
<?php
include_once "../vendor/autoload.php";

use SCHOENBECK\Router\GlobalsRequest;
use SCHOENBECK\Router\Router;

$request = new GlobalsRequest();
$router = new Router($request);

$router->addRoute("/","IndexController::indexAction");

echo $router->resolveRoute();
```
### Load routers from a `yaml` file

We can define in a `yaml` file all the routes of our application. This facilitates our life when we need to *migrate*, *modify*, or later *add* new routes.

The route definition should follow the example below:

```yaml
base_path: /blog

routes:
  index: [/index, IndexController::indexAction]
  contact: [/contact, ContactController::indexAction]
  about: [/about, AboutController::indexAction]
```

Now we only have to add the routes file name:

```php
$router->addRoutesFromFile("routes.yml");
```

## License

MIT Licensed, http://www.opensource.org/licenses/MIT