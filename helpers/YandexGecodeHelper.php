<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (ÑêèêÑ)
 * @date 10.11.2016
 */
namespace skeeks\yii2\dadataSuggestApi\helpers;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\JsonFormatter;

/**
 * TODO: Äîïèñàòü, äîáàâèòü ïğîâåğêè è êıø
 *
 * @property array|null $coordinates
 *
 * Class YandexGecodeHelper
 *
 * @package skeeks\yii2\dadataSuggestApi\helpers
 */
class YandexGecodeHelper extends Component
{
    /**
     * @var SuggestAddressModel|null
     */
    public $addressObject = null;

    /**
     * @return array
     */
    public function getCoordinates()
    {
        if ($this->addressObject)
        {
            return static::getYandexCoordinatesByAdress((string) $this->addressObject);
        }

        return [];
    }

    /**
     * @param $addressString
     *
     * @return array
     */
    static public function getYandexCoordinatesByAdress($addressString)
    {
        if ($data = static::getYandexFirstFutureMemeber($addressString))
        {
            if ($coordinates = ArrayHelper::getValue($data, 'GeoObject.Point.pos'))
            {
                if ($coordinates)
                {
                    $data = explode(" ", $coordinates);
                    return [$data[1], $data[0]];
                }
            }
        }

        return [];
    }

    /**
     * TODO:: add cache
     * @param $addressString
     *
     * @return array
     */
    static public function getYandexFirstFutureMemeber($addressString)
    {
        if ($data = static::getYandexData($addressString))
        {
            if ($featureMember = ArrayHelper::getValue($data, 'response.GeoObjectCollection.featureMember'))
            {
                if (isset($featureMember[0]))
                {
                    return $featureMember[0];
                }
            }
        }

        return [];
    }
    /**
     * Ïîëíûé îòâåò yandex api
     *
     * @param $address
     *
     * @return array
     */
    static public function getYandexData($addressString)
    {
        $request    = (new Client([
                            'formatters' =>
                            [
                                Client::FORMAT_JSON => JsonFormatter::class
                            ]
                        ]))->createRequest()
                        ->setUrl("https://geocode-maps.yandex.ru/1.x/?geocode={$addressString}&format=json")
                        ->setOptions([
                            'timeout' => 1
                        ])
        ;
        $response = $request->send();

        if ($response->isOk)
        {
            return (array) $response->data;
        }

        return [];
    }


}