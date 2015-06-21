<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:47
 */

namespace PromisePay;
use PromisePay\DataObjects\Item;
include_once '../init.php';
include_once 'GUID.php';


class ItemTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateItemSuccessfully()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new ItemRepository();
        $id = GUID();
        $buyerId = "ec9bf096-c505-4bef-87f6-18822b9dbf2c"; //some user created before
        $sellerId = "fdf58725-96bd-4bf8-b5e6-9b61be20662e"; //some user created before
        $itemArr = array(
            "id" => $id,
            "name" => 'Test Item #1',
            "amount" => 1000,
            "payment_type_id" => 1,
            "buyer_id" => $buyerId,
            "seller_id" => $sellerId,
            "description" => 'Description'
        );
        $item = new Item($itemArr);
        $createdItem = $repo->createItem($item);
        $this->assertEquals($item->getId(), $createdItem->getId());
        $this->assertEquals($item->getName(), $createdItem->getName());
        $this->assertEquals($item->getAmount(), $createdItem->getAmount());
        $this->assertEquals($item->getPaymentType(), $createdItem->getPaymentType());
        $this->assertEquals($item->getDescription(), $createdItem->getDescription());
    }

    public function testListAllItemsSuccessfully() {
        $repo = new ItemRepository();
        $items = $repo->getListOfItems(200);
        $this->assertNotNull($items);
        $this->assertTrue(count($items)>0);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListItemsNegativeParams() {
        $repo = new ItemRepository();
        $repo->getListOfItems(-10,-20);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListItemsTooHighLimit()
    {
        $repo = new ItemRepository();
        $repo->getListOfItems(-201);
    }

    public function testGetItemSuccessful()
    {
        //First, create a user with known id
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new ItemRepository();
        $id = GUID();
        $buyerId = "ec9bf096-c505-4bef-87f6-18822b9dbf2c"; //some user created before
        $sellerId = "fdf58725-96bd-4bf8-b5e6-9b61be20662e"; //some user created before
        $itemArr = array(
            "id" => $id,
            "name" => 'Test Item #1',
            "amount" => 1000,
            "payment_type_id" => 1,
            "buyer_id" => $buyerId,
            "seller_id" => $sellerId,
            "description" => 'Description'
        );
        $item = new Item($itemArr);
        $createdItem = $repo->createItem($item);

        //Then, get item
        $gotItem = $repo->getItemById($id);

        $this->assertNotNull($gotItem);
        $this->assertEquals($id, $gotItem->getId());
    }

    public function testDeleteItemSuccessful()
    {
//        //First, create a user with known id
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new ItemRepository();
        $id = GUID();
        $buyerId = "ec9bf096-c505-4bef-87f6-18822b9dbf2c"; //some user created before
        $sellerId = "fdf58725-96bd-4bf8-b5e6-9b61be20662e"; //some user created before
        $itemArr = array(
            "id" => $id,
            "name" => 'Test Item #1',
            "amount" => 1000,
            "payment_type_id" => 1,
            "buyer_id" => $buyerId,
            "seller_id" => $sellerId,
            "description" => 'Description'
        );
        $item = new Item($itemArr);
        $createdItem = $repo->createItem($item);

        //Then, get item
        $gotItem = $repo->getItemById($id);

        $this->assertNotNull($gotItem);
        $this->assertEquals($id, $gotItem->getId());

        $repo->deleteItem($id);

        $deletedItem = $repo->getItemById($id);
        $this->assertNotNull($deletedItem);
        $this->assertEquals('cancelled',$deletedItem->getState());
    }


}

