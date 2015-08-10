<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 23.06.2015
 * Time: 17:24
 */

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

        $repo = new CardAccountRepository();
        $carAcc = new CardAccount($info);

        $this->assertEquals($carAcc->getCard()->getFullName(), $repo->createCardAccount($carAcc)->getFullName());
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

        $repo = new CardAccountRepository();
        $carAcc= new CardAccount($info);
        $repo->createCardAccount($carAcc);
        $this->assertEquals($carAcc->getUserId(), $repo->getCardAccountById($userid)->getUserId());

    }


    public function testDeleteCardAccountTest()
    {
        $cardAcc = new CardAccountRepository();
        $cardAcc->deleteCardAccount('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
        $cardAcc->getCardAccountById('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
    }


}
 