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
 * Class ApiResponseOk
 *
 * @package skeeks\yii2\dadataSuggest\helpers
 */
class ApiResponseOk extends ApiResponse
{
    /**
     * @return bool
     */
    public function getIsError()
    {
        return false;
    }
}