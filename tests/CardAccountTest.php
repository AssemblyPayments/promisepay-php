<?php

namespace PromisePay;


use PromisePay\DataObjects\CardAccount;
include_once __DIR__ . '/../init.php';

class CardAccountTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateCardAccountTest()
    {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $info = array(
            'id' => $userid,
            'active'  => 'true',
            'card'=>array(
                'fullname' => 'test',
                'number'=>'4111111111111111',
                "expiry_month"=>'12',
                "expiry_year"=>'2020',
                "cvv"=>'123',
            )
        );

        $cardRepo = new CardAccountRepository();
        $cardAccount = new CardAccount($info);

        $this->assertEquals($cardAccount->getCard()->getFullName(), $cardRepo->createCardAccount($cardAccount)->getCard()->getFullName());
    }

    public function testGetCardAccountById()
    {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $info = array(
            'id' => $userid,
            'active'  => 'true',
            'card'=>array(
                'fullname' => 'test new',
                'number'=>'4111111111111111',
                "expiry_month"=>'10',
                "expiry_year"=>'2020',
                "cvv"=>'133',
            )
        );

        $cardRepo = new CardAccountRepository();
        $cardAccount= new CardAccount($info);
        $cardRepo->createCardAccount($cardAccount);
        $this->assertEquals($cardAccount->getUserId(), $cardRepo->getCardAccountById($userid)->getUserId());

    }


    public function testDeleteCardAccountTest()
    {
        $cardAccount = new CardAccountRepository();
        $cardAccount->deleteCardAccount('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
        $cardAccount->getCardAccountById('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
    }


}
 
