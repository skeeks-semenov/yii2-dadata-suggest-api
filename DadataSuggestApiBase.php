<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.09.2016
 */
namespace skeeks\yii2\dadataSuggest;

use skeeks\cms\helpers\StringHelper;
use skeeks\yii2\dadataSuggest\helpers\ApiResponse;
use yii\base\Component;
use yii\helpers\ArrayHelper;
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
     * Коды ответа на запрос
     *
     * @see https://dadata.ru/api/suggest/#response-address
     * @var array
     */
    static public $errorStatuses = [
        '400'   =>  'Некорректный запрос',
        '401'   =>  'В запросе отсутствует API-ключ',
        '403'   =>  'В запросе указан несуществующий API-ключ',
        '405'   =>  'Запрос сделан с методом, отличным от POST',
        '413'   =>  'Нарушены ограничения',
        '500'   =>  'Произошла внутренняя ошибка сервиса во время обработки',
    ];

    /**
     * @param $apiMethod
     * @param array $params
     * @param string $requestMethod
     *
     * @return $this
     */
    public function _createHttpRequest($apiMethod, array $params = [], $requestMethod = "POST")
    {
        $apiUrl = $this->baseUrl . $apiMethod;
        $client     = new Client();

        if ($requestMethod == "POST")
        {
            $client->requestConfig = ['format' => Client::FORMAT_JSON];
        }

        $request    = $client
            ->createRequest()
            ->setUrl($apiUrl)
            ->setMethod($requestMethod)
            ->addHeaders(['Authorization' => "Token " . $this->authorization_token])
            ->addHeaders(['Accept' => 'application/json'])
            ->setData($params)
            ->setOptions([
                'timeout' => $this->timeout
            ])
        ;

        if ($requestMethod == "POST")
        {
            return $request->addHeaders(['Content-type' => 'application/json']);

        } else if ($requestMethod == "GET")
        {
            return $request;
        }
        throw new \InvalidArgumentException("Method {$requestMethod} not allow");
    }

    /**
     * @param $apiMethod            вызываемый метод, список приведен далее, пример /rs/suggest/address
     * @param array $params         параметры соответствующие методу запроса пример ['query' => 'Хабар', 'count' => 10]
     *
     * @return ApiResponse
     */
    public function send($apiMethod, array $params = [], $requestMethod = "POST")
    {
        $requestMethod = strtoupper($requestMethod);

        $httpRequest        = $this->_createHttpRequest($apiMethod, $params, $requestMethod);
        $response           = $httpRequest->send();

        $apiResponse = new ApiResponse([
            'api'               => $this,
            'requestUrl'        => $this->baseUrl . $apiMethod,
            'requestHttpRequest'=> $httpRequest,
            'requestParams'     => $params,
            'apiMethod'         => $apiMethod,
            'requestMethod'     => $requestMethod,
        ]);;

        try
        {
            $dataResponse                   = (array) Json::decode($response->content);
            $apiResponse->data              = $dataResponse;

        } catch (\Exception $e)
        {
            \Yii::error("Json api response error: " . $e->getMessage() . ". Response: \n{$response->content}", self::className());
            $apiResponse->isError       = true;
            $apiResponse->errorMessage = $e->getMessage();
            $apiResponse->errorCode = $e->getCode();
        }

        $apiResponse->statusCode     = $response->statusCode;
        $apiResponse->content        = $response->content;

        if (!$response->isOk)
        {
            \Yii::error($response->content, self::className());

            $apiResponse->isError       = true;
            $apiResponse->errorMessage  = ArrayHelper::getValue(static::$errorStatuses, $response->statusCode);
            $apiResponse->errorCode     = $apiResponse->statusCode;
            $apiResponse->errorData     = $apiResponse->data;
        }

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