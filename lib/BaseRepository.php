<?php
namespace PromisePay;

use Httpful\Request;
use PromisePay\Exception;
use PromisePay\Log\Logger;

/**
 * Class BaseRepository
 * @package PromisePay
 */
class BaseRepository
{
	/**
	 * Constant 
	 * Entity list limit.
	 * 
	 * @const int ENTITY_LIST_LIMIT
	 */
	const ENTITY_LIST_LIMIT = 200;
	
	/**
	 * Construct
	 * Invokes Configuration class, thus bringing API configuration values to the namespace scope.
	 */
	public function __construct() {
		new Configuration;
	}

    public function RestClient($method, $entity, $payload = null, $mime = null)
    {
        $url = constant(__NAMESPACE__ . '\API_URL') . $entity . '?' . $payload;
		
        switch ($method) {
            case 'get':
                $response = Request::get($url)->authenticateWith(constant(__NAMESPACE__ . '\API_LOGIN'), constant(__NAMESPACE__ . '\API_PASSWORD'))->send();
                return $response;
                break;

            case 'post':
                $response = Request::post($url)->body($payload, $mime)->authenticateWith(API_LOGIN, API_PASSWORD)->send();
                return $response;
                break;

            case 'delete':
                $response = Request::delete($url)->authenticateWith(API_LOGIN, API_PASSWORD)->send();
                return $response;
                break;

            case 'patch':
                $response = Request::patch($url)->body($payload, $mime)->authenticateWith(API_LOGIN, API_PASSWORD)->send();
                return $response;
                break;
				
			default:
				throw new Exception\ApiUnsupportedRequestMethod("Unsupported request method $method.");
        }
    }

    public function checkIdNotNull($id)
    {
        if($id == null)
        {
            Logger::logging('Fatal error: Id is empty');
            throw new Exception\Argument('id is empty');
        }
    }

    public function paramsListCorrect($limit, $offset)
    {
        if ($limit < 0 || $offset < 0 )
        {
            Logger::logging('Fatal error:limit and offset values should be nonnegative!');
            throw new Exception\Argument('limit and offset values should be nonnegative!');
        }

        if ($limit > self::ENTITY_LIST_LIMIT)
        {
            Logger::logging('Fatal error:Max value for limit parameter!');
            throw new Exception\Argument('Max value for limit parameter');
        }
    }


}
