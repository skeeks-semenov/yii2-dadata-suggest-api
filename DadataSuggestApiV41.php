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
     * Определяет город по IP-адресу в России. Использует IP-адрес клиента либо значение из параметра ip.
     * @see https://dadata.ru/api/detect_address_by_ip/
     * @param $ip
     *
     * @return helpers\ApiResponse
     */
    public function detectAddressByIp($ip)
    {
        return $this->send('/rs/detectAddressByIp', ['ip' => $ip], "GET");
    }

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
        return $this->send('/rs/suggest/address', $params);
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
        return $this->send('/rs/suggest/fio', $params);
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
        return $this->send('/rs/suggest/party', $params);
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
        return $this->send('/rs/suggest/bank', $params);
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
        return $this->send('/rs/suggest/email', $params);
    }
}