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
 * @property bool isError
 * @property bool isOk
 *
 * @package skeeks\yii2\dadataSuggest\helpers
 */
abstract class ApiResponse extends Component
{
    /**
     * @var string
     */
    public $requestMethod;

    /**
     * @var string
     */
    public $requestUrl;

    /**
     * @var array
     */
    public $requestParams = [];


    /**
     * данные соответствующие методу запроса
     * @var mixed
     */
    public $data;

    /**
     * @var string Оригинальный ответ апи
     */
    public $content;


    /**
     * Seerver response code
     * @var int
     */
    public $statusCode;

    /**
     * @var Api
     */
    public $api;

    /**
     * Ответны запрос ошибочный?
     * @return bool
     */
    abstract public function getIsError();

    /**
     * @return bool
     */
    public function getIsOk()
    {
        return !$this->isError;
    }
}