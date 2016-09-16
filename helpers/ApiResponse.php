<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.07.2016
 */
namespace skeeks\yii2\dadataSuggest\helpers;

use v3toys\v3project\api\Api;
use yii\base\Component;

/**
 * Описание общих полей запросов
 *
 * @property bool isOk read-only
 *
 * @package skeeks\yii2\dadataSuggest\helpers
 */
class ApiResponse extends Component
{
    /**
     * @var bool Ответ апи считается ошибочным или нет
     */
    public $isError = false;

    /**
     * @var Api Сам объект апи
     */
    public $api;

    /**
     * @var string запрошеный метод апи
     */
    public $apiMethod;




    /**
     * @var string полный url запроса
     */
    public $requestUrl;

    /**
     * @var array переданные параметры
     */
    public $requestParams = [];

    /**
     * @var array метод запроса get или post
     */
    public $requestMethod;

    /**
     * @var объект запроса (Guzzle|Yii2 http client)
     */
    public $requestObject;




    /**
     * @var array ответ апи с которым и надо работать
     */
    public $data;

    /**
     * @var string оригинальный ответ апи необработанный
     */
    public $content;


    /**
     * @var int Server response code
     */
    public $statusCode;



    /**
     * @var string сообщение об ошибке
     */
    public $errorMessage = '';

    /**
     * @var код об ошибке
     */
    public $errorCode;

    /**
     * @var данные об ошибке
     */
    public $errorData;


    /**
     * @return bool
     */
    public function getIsOk()
    {
        return !$this->isError;
    }
}