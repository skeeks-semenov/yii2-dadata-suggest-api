<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */
namespace skeeks\yii2\dadataSuggest;

use skeeks\cms\helpers\StringHelper;
use skeeks\yii2\dadataSuggest\helpers\ApiResponseError;
use skeeks\yii2\dadataSuggest\helpers\ApiResponseOk;
use yii\base\Component;
use yii\helpers\Json;
use yii\httpclient\Client;

/**
 * @see https://dadata.ru/api/suggest/
 *
 * @property string $version read-only
 * @property string $baseUrl read-only
 *
 * Class DadataSuggestApiBase
 *
 * @package skeeks\yii2\dadataSuggest
 */
abstract class DadataSuggestApiBase extends Component
{
    /**
     * api vesrion
     */
    const VERSION = '4_1';

    /**
     * @var string
     */
    public $apiUrl = 'https://suggestions.dadata.ru/suggestions/api/';

    /**
     * @var string
     */
    public $authorization_token = '';

    /**
     * @var int set timeout to 15 seconds for the case server is not responding
     */
    public $timeout = 30;



    /**
     * @param $method           вызываемый метод, список приведен далее, пример /rs/suggest/address
     * @param array $params     параметры соответствующие методу запроса пример ['query' => 'Хабар', 'count' => 10]
     *
     * @return ApiResponseError|ApiResponseOk
     */
    public function sendPost($method, array $params = [])
    {
        $apiUrl = $this->baseUrl . $method;

        $client = new Client([
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ]
        ]);

        $response = $client->createRequest()
                ->setMethod("POST")
                ->setUrl($apiUrl)
                ->addHeaders(['Content-type' => 'application/json'])
                ->addHeaders(['Accept' => 'application/json'])
                ->addHeaders(['Authorization' => $this->authorization_token])
                ->addHeaders(['user-agent' => 'JSON-RPC PHP Client'])
                ->setData($params)
                ->setOptions([
                    'timeout' => $this->timeout
                ])
            ->send();
        ;

        $apiResponse = null;

        try
        {
            $dataResponse = (array) Json::decode($response->content);
        } catch (\Exception $e)
        {
            \Yii::warning("Json api response error: " . $e->getMessage() . ". Response: \n{$response->content}", self::className());
            $apiResponse = new ApiResponseError();
            $apiResponse->error_message = $e->getMessage();
        }


        if (!$apiResponse)
        {
            if (!$response->isOk)
            {
                \Yii::error($response->content, self::className());
                $apiResponse = new ApiResponseError();
            } else
            {
                $apiResponse = new ApiResponseOk();
            }
        }


        $apiResponse->api            = $this;
        $apiResponse->statusCode     = $response->statusCode;

        $apiResponse->requestMethod  = $method;
        $apiResponse->requestParams  = $params;
        $apiResponse->requestUrl     = $apiUrl;

        $apiResponse->content        = $response->content;
        $apiResponse->data           = $dataResponse;

        return $apiResponse;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return static::VERSION;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->apiUrl . $this->version;
    }
}