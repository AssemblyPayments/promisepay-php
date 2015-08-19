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
           'user_id' => $userid,
           'card'=>array(
               'full_name' => 'Bobby Buyer',
               'number'=>'4111111111111111',
               "expiry_month"=>'06',
               "expiry_year"=>'2020',
               "cvv"=>'123',
           )
       );
       $cardRepo = new CardAccountRepository();
       $cardAccount = new CardAccount($info);
       $createdAccount = $cardRepo->createCardAccount($cardAccount);
       
       $this->assertNotNull($createdAccount->getCreatedAt());
       $this->assertNotNull($createdAccount->getId());
    }

    public function testGetCardAccountById()
    {
       $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
       $info = array(
           'user_id' => $userid,
           'card'=>array(
               'full_name' => 'Bobby Buyer',
               'number'=>'4111111111111111',
               "expiry_month"=>'06',
               "expiry_year"=>'2020',
               "cvv"=>'123',
           )
       );
       $cardRepo = new CardAccountRepository();
       $cardAccount = new CardAccount($info);
       $createdAccount = $cardRepo->createCardAccount($cardAccount);
       
       $this->assertNotNull($createdAccount->getCreatedAt());
       $this->assertNotNull($createdAccount->getId());

       $info = array(
           'id' => $createdAccount->getId()
       );

       $cardAccount = new CardAccount($info);
       $fetchedCardAccount = $cardRepo->getCardAccountById($cardAccount->getId());

       var_dump($fetchedCardAccount);
       $this->assertNotNull($fetchedCardAccount->getCreatedAt());
    }

    public function testDeleteCardAccountTest()
    {
       $cardAccount = new CardAccountRepository();
       $cardAccount->deleteCardAccount('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
       $cardAccount->getCardAccountById('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
    }


}
 
