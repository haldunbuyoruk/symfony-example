# Haldun Buyorük - Symfony Example

## Setup .evn

change this line: 

``` DATABASE_URL=mysql://root:password@localhost:3306/symfony_example```

## Run following comments

```command
composer install
```

```command
php bin/console doctrine:database:create
```

```command
php bin/console doctrine:schema:update --force
```

```command
npm install
```

```command

touch .bowerrc
```

```command

vi .bowerrc
```

Paste the follwing to the .bowerrc

```
{
  "directory": "assets"
}

```


```command

bower install
```

```command

grunt
```

```command

php bin/console server:run
```

Logs:

``` var/log/transactions.log ```
