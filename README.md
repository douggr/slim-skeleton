# dl2/slim-skeleton: Skeleton Application Slim Framework 3.8

Quickly setup and start working on a new Slim Framework 3 application.

## Installation

Clone this repository or create a project using [composer](https://getcomposer.org/):

> Replace `[my-app-name]` with the desired directory name for your new application.

```shell
$ git clone https://github.com/dl2tech/slim-skeleton [my-app-name]
$ cd [my-app-name]
$ composer install

# or

$ composer create-project dl2/slim-skeleton [my-app-name]
```

After the donwload is complete, you'll want to:
  - Point your virtual host document root to the `public/` directory.
  - Ensure `data/logs/` and `data/cache/` is writeable by your webserver.

To run the application in development, you can also run this command.

```shell
$ composer run start
```

## Tests

Just run `composer test`.

## Versioning

Follows the [Slim versioning](https://github.com/slimphp/Slim/releases/latest).

## License

The Slim Controller extension is licensed under the MIT license.
See [License File](LICENSE.md) for more information.
