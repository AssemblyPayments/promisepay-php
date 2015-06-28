<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:47
 */

namespace PromisePay;


use PromisePay\DataObjects\PayPalAccount;

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

        $this->assertEquals($ppalAccount->paypal->getAccountName(),$create->paypal->getAccountName());

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
        $repo->createPayPalAccount($ppalAccount);
        $this->assertEquals($ppalAccount->getUserId(),$repo->getBankAccountById($userid));

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
        $this->assertEquals($repo->createPayPalAccount($ppalAccount)->getUserId(), $repo->getUserForPayPalAccount($userid)->getUserId());


    }

    public function deletePayPalAccountTest()
    {
        $ppalAccount = new PayPalAccountRepository();
        $ppalAccount->deletePayPalAccount('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
        $ppalAccount->getPayPalAccountById('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
    }
}
 