<?php
namespace PromisePay;

use PromisePay\DataObjects\Token;
use PromisePay\DataObjects\Widget;
use PromisePay\Exception;
use PromisePay\Log;

class TokenRepository extends  BaseRepository
{
    public function requestToken()
    {
        $response = $this->RestClient('get','request_token/');
        $jsonData = json_decode($response->raw_body, true)['request_token'];
        return $jsonData;
    }

    public function requestSessionToken(Token $token)
    {

        $payload = '';
        $preparePayload = array(
        'current_user_id' => $token->getCurrentUserId(),
        'item_name'=> $token->getItemName(),
        'amount'=> $token->getAmount(),
        'external_item_id'=> $token->getExternalItemId(),
        'payment_type_id'=> $token->getPaymentType(),
        'fee_ids'=> $token->getFeeIds(),
        'seller_email'=> $token->getSellerEmail(),
        'seller_firstname'=> $token->getSellerFirstName(),
        'seller_lastname'=> $token->getSellerLastName(),
        'seller_country'=> $token->getSellerCountry(),
        'external_seller_id'=> $token->getExternalSellerId(),
        'buyer_email'=> $token->getBuyerEmail(),
        'buyer_firstname'=> $token->getBuyerFirstName(),
        'buyer_lastname'=> $token->getBuyerLastName(),
        'buyer_country'=> $token->getBuyerCountry(),
        'external_buyer_id'=> $token->getExternalBuyerId(),
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }

        $response = $this->RestClient('get', 'request_session_token/', $payload, '');
        $jsonRaw = json_decode($response->raw_body, true);

        return $jsonRaw;
    }

    public function getWidget($sessionToken)
    {
        $response = $this->RestClient('get', 'widget/session_token?'.$sessionToken);
        $jsonData = json_decode($response->raw_body, true);
        if(is_array($jsonData))
        {
            if (array_key_exists("widget", $jsonData))
            {
                $jsonData = $jsonData["widget"];
                $widget = new Widget($jsonData);
                return $widget;
            }
        }
        return null;
    }

}