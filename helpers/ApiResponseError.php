<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.07.2016
 */
namespace skeeks\yii2\dadataSuggest\helpers;

use yii\base\Component;

/**
 * Class ApiResponseError
 *
 * @package skeeks\yii2\dadataSuggest\helpers
 */
class ApiResponseError extends ApiResponse
{
    /**
     * код ошибки
     * @var string
     */
    public $error_code;

    /**
     * описание ошибки
     * @var string
     */
    public $error_message;

    /**
     * данные дающие дополнительную информацию об ошибке
     * @var string
     */
    public $error_data;

    /**
     * @return bool
     */
    public function getIsError()
    {
        return true;
    }
}