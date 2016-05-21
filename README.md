# grastin-api-php
Неофициальный PHP-клиент для API службы доставки Грастин

Установка
------------

Рекомендуемый способ установки через
[Composer](http://getcomposer.org):

```
$ composer require kilylabs/grastin-api-php
```

Использование
-----

Пример кода

```php
<?php

define('GRASTIN_DEBUG',true);

require('vendor/autoload.php');

$d = new Kily\Delivery\Grastin\Delivery('<YOUR API KEY HERE>');

var_dump($d->orderinformation(["ИВН N-Р-33531","ИВН B-17622"]));
var_dump($d->orderinformation("ИВН B-17622"));
var_dump($d->selfpickup());
var_dump($d->warehouse());
var_dump($d->deliveryregion());
var_dump($d->boxberryselfpickup());
var_dump($d->boxberrypostcode());
var_dump($d->hermesselfpickup());
var_dump($d->statushistory(["ИВН N-Р-33531","ИВН B-17622"]));
var_dump($d->printactofreceiving(["ИВН N-Р-33531","ИВН B-17622"=>2])); // returns SplTempFileObject
```

TODO
-----
- реализовать API методы
 - CalcShipingCost
 - agentreportlist
 - ContractList
 - orderlist
 - tcofficelist
 - newordercourier
 - newordermail
 - neworderboxberry
 - neworderhermes
 - RequestForIntake
 - Печать маркировок
