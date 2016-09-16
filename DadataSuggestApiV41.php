<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */
namespace skeeks\yii2\dadataSuggest;
/**
 * Class ApiV5
 *
 * @package v3toys\v3project\api
 */
class DadataSuggestApiV41 extends DadataSuggestApiBase
{
    const VERSION = '4_1';

    /**
     * Адреса
     *
     * @see https://dadata.ru/api/suggest/#response-address
     * @param array $params
     *
     * @return helpers\ApiResponse
     */
    public function getAddress($params = [])
    {
        return $this->sendPost('/rs/suggest/address', $params);
    }

    /**
     * ФИО
     *
     * @see https://dadata.ru/api/suggest/#response-fullname
     * @param array $params
     *
     * @return helpers\ApiResponse
     */
    public function getFio($params = [])
    {
        return $this->sendPost('/rs/suggest/fio', $params);
    }

    /**
     * Организации
     *
     * @see https://dadata.ru/api/suggest/#response-party
     * @param array $params
     *
     * @return helpers\ApiResponse
     */
    public function getParty($params = [])
    {
        return $this->sendPost('/rs/suggest/party', $params);
    }


    /**
     * Банки
     *
     * @see https://dadata.ru/api/suggest/#response-bank
     * @param array $params
     *
     * @return helpers\ApiResponse
     */
    public function getBank($params = [])
    {
        return $this->sendPost('/rs/suggest/bank', $params);
    }

    /**
     * Email
     *
     * @see https://dadata.ru/api/suggest/#response-email
     * @param array $params
     *
     * @return helpers\ApiResponse
     */
    public function getEmail($params = [])
    {
        return $this->sendPost('/rs/suggest/email', $params);
    }
}