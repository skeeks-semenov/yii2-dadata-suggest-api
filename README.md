API подсказок Dadata.ru
===================================

Info
------------
* https://dadata.ru/api/suggest/

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

add to composer.json
```
"repositories": [
    {
        "type": "git",
        "url":  "https://github.com/skeeks-semenov/yii2-dadata-suggest.git"
    }
],
```

Either run

```
php composer.phar require --prefer-dist skeeks/yii2-dadata-suggest "*"
```

or add

```
"skeeks/yii2-dadata-suggest": "*"
```

How to use
----------

```php
//App config
[
    'components'    =>
    [
    //....
        'dadataSuggest' =>
        [
            'class'                 => 'skeeks\yii2\dadataSuggest\DadataSuggestApi',
            'authorization_token'   => 'token',
            'timeout'               => 12,
        ],
    //....
    ]
]

```

Examples
----------

### Адресные подсказки

```php
$response = \Yii::$app->dadataSuggest->send('/rs/suggest/address', [
    'query' => 'Хабар',
    'count' => 10
]);

if ($response->isError)
{
    print_r($response->errorMessage);
    print_r($response->errorData);
    print_r($response->errorCode);
} else
{
    print_r($response->data);
}
```

### Определение положения пользователя по ip
```php
$response = \Yii::$app->dadataSuggest->detectAddressByIp(\Yii::$app->request->userIP);
```

```php
$response = \Yii::$app->dadataSuggest->getAddress([
    'query' => 'Хабар',
    'count' => 10
]);

if ($response->isError)
{
    print_r($response->errorMessage);
    print_r($response->errorData);
    print_r($response->errorCode);
} else
{
    print_r($response->data);
}

```

### Подсказки email
```php
$response = \Yii::$app->dadataSuggest->getEmail([
    'query' => 'info@',
    'count' => 10
]);

if ($response->isError)
{
    print_r($response->errorMessage);
    print_r($response->errorData);
    print_r($response->errorCode);
} else
{
    print_r($response->data);
}


```

### Подсказки фио
```php
$response = \Yii::$app->dadataSuggest->getFio([
    'query' => 'Семен',
    'count' => 10
]);

if ($response->isError)
{
    print_r($response->errorMessage);
    print_r($response->errorData);
    print_r($response->errorCode);
} else
{
    print_r($response->data);
}

```
___

> [![skeeks!](https://gravatar.com/userimage/74431132/13d04d83218593564422770b616e5622.jpg)](http://skeeks.com)  
<i>SkeekS CMS (Yii2) — fast, simple, effective!</i>  
[skeeks.com](http://skeeks.com) | [cms.skeeks.com](http://cms.skeeks.com) | [marketplace.cms.skeeks.com](http://marketplace.cms.skeeks.com)

