# Paginate plugin for CakePHP

## Installation TODO

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/Paginate
```

Enquanto os plugins não forem publicados via composer, a instalação deverá ser feita da seguinte maneira:

- Copiar a pasta Paginate para a pasta /plugins/ do projeto
- No terminal do container, executar o comando: bin/cake plugin load Paginate
- No arquivo composer.json acrescentar na chave autoload.psr-4 o valor: "Paginate\\": "./plugins/Paginate/src/"
- No arquivo composer.json acrescentar na chave autoload-dev.psr-4 o valor: "Paginate\\Test\\": "./plugins/Paginate/tests/"
- No terminal, executar o comando: php composer.phar dumpautoload
