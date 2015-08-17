<?php


namespace PromisePay;


use PromisePay\DataObjects\PayPalAccount;
include_once __DIR__ . '/../init.php';

class PayPalAccountTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatePaypalAccount()
    {
        $repo  = new PayPalAccountRepository();
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $params  = array(
            'user_id'=> $userid,
            'active'=>'true',
            'paypal'=>array(
                'email'=>'test@paypalname.com'
            )
        );

        $ppalAccount = new PayPalAccount($params);
        $create = $repo->createPayPalAccount($ppalAccount);

        $this->assertEquals($ppalAccount->getPayPal()->getPayPalAccountEmail(),$create->getPayPal()->getPayPalAccountEmail());

        $this->assertNotNull($create->getCreatedAt());
        $this->assertNotNull($create->getUpdatedAt());
    }

    public function testGetAccountSuccessfully()
    {
        $repo  = new PayPalAccountRepository();
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $params  = array(
            'user_id'=> $userid,
            'active'=>'true',
            'paypal'=>array(
                'email'=>'test@paypalname.com'
            )
        );

        $ppalAccount = new PayPalAccount($params);
        $createPaypalAccount = $repo->createPayPalAccount($ppalAccount);
        $getPaypalAccount = $repo->getPayPalAccountById($createPaypalAccount->getId());
        $this->assertEquals($createPaypalAccount->getId(), $getPaypalAccount->getId());

    }

    public function testGetUserForAccountSuccessfully()
    {
        $repo  = new PayPalAccountRepository();
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $params  = array(
            'user_id'=> $userid,
            'active'=>'true',
            'paypal'=>array(
                'email'=>'test@paypalname.com'
            )
        );
        $ppalAccount = new PayPalAccount($params);

        $createPaypalAccount = $repo->createPayPalAccount($ppalAccount);
        $getUsersPaypalAccount = $repo->getUserForPayPalAccount($createPaypalAccount->getId());

        $gotUserId = $getUsersPaypalAccount->getId();
        $this->assertEquals($gotUserId, $userid);


    }

    public function deletePayPalAccountTest()
    {
        $ppalAccount = new PayPalAccountRepository();
        $ppalAccount->deletePayPalAccount('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
        $ppalAccount->getPayPalAccountById('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
    }
}
 