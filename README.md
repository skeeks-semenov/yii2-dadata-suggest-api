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
        "url":  "https://github.com/skeeks-semenov/yii2-dadata-suggest-api.git"
    }
],
```

Either run

```
php composer.phar require --prefer-dist skeeks/yii2-dadata-suggest-api "*"
```

or add

```
"skeeks/yii2-dadata-suggest-api": "*"
```

How to use
----------

```php
//App config
[
    'components'    =>
    [
    //....
        'dadataSuggestApi' =>
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
$response = \Yii::$app->dadataSuggestApi->send('/rs/suggest/address', [
    'query' => 'Хабар',
    'count' => 10
]);

print_r($response->httpClientRequest->url);     //Full api url
print_r($response->httpClientRequest->data);    //Request data
print_r($response->httpClientRequest->method);  //Request method
print_r($response->httpClientRequest->headers); //Request headers

print_r($response->httpClientResponse->statusCode); //Server response code
print_r($response->httpClientResponse->content);    //Original api response

if ($response->isError)
{
    print_r($response->errorMessage); //Расшифровка кода
    print_r($response->errorData);
    print_r($response->errorCode);
} else
{
    print_r($response->data); //Array response data
}
```

### Определение положения пользователя по ip
```php
$response = \Yii::$app->dadataSuggestApi->detectAddressByIp(\Yii::$app->request->userIP);
```


### Подсказки email
```php
$response = \Yii::$app->dadataSuggestApi->getEmail([
    'query' => 'info@',
    'count' => 10
]);
```

### Подсказки фио
```php
$response = \Yii::$app->dadataSuggestApi->getFio([
    'query' => 'Семен',
    'count' => 10
]);
```
___

> [![skeeks!](https://gravatar.com/userimage/74431132/13d04d83218593564422770b616e5622.jpg)](http://skeeks.com)  
<i>SkeekS CMS (Yii2) — fast, simple, effective!</i>  
[skeeks.com](http://skeeks.com) | [cms.skeeks.com](http://cms.skeeks.com) | [marketplace.cms.skeeks.com](http://marketplace.cms.skeeks.com)

