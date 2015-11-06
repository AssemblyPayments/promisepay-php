<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class ItemTest extends \PHPUnit_Framework_TestCase {
    
    protected $GUID, $buyerId, $sellerId, $itemData;
    
    public function setUp() {
        $this->GUID = GUID();
        $this->buyerId = "ec9bf096-c505-4bef-87f6-18822b9dbf2c";
        $this->sellerId = "fdf58725-96bd-4bf8-b5e6-9b61be20662e";
        
        $this->itemData = array(
            "id"              => $this->GUID,
            "name"            => 'Test Item #1',
            "amount"          => 1000,
            "payment_type_id" => 1,
            "buyer_id"        => $this->buyerId,
            "seller_id"       => $this->sellerId,
            "description"     => 'Description'
        );
    }

    public function testCreateItem() {
        $createItem = PromisePay::createItem($this->itemData);
        
        $this->assertEquals($this->itemData['id'], $createItem['id']);
        $this->assertEquals($this->itemData['name'], $createItem['name']);
        $this->assertEquals($this->itemData['amount'], $createItem['amount']);
        $this->assertEquals($this->itemData['payment_type_id'], $createItem['payment_type_id']);
        $this->assertEquals($this->itemData['description'], $createItem['description']);
    }

    public function testListAllItems() {
        $fetchList = PromisePay::getListOfItems(200);
        
        $this->assertNotNull($fetchList);
        $this->assertTrue(count($fetchList) > 0);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListItemsNegativeParams() {
        PromisePay::getListOfItems(-10, -20);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListItemsTooHighLimit() {
        PromisePay::getListOfItems(201);
    }
    
    
    public function testGetItem() {
        // Create the item
        PromisePay::createItem($this->itemData);
        
        // Then, fetch it
        $getItem = PromisePay::getItemById($this->GUID);

        $this->assertNotNull($getItem);
        $this->assertEquals($this->GUID, $getItem['id']);
    }
    
    public function testDeleteItem() {
        // Create the item
        PromisePay::createItem($this->itemData);
        
        // Fetch its data
        $getItem = PromisePay::getItemById($this->GUID);
        
        $this->assertNotNull($getItem);
        $this->assertEquals($this->GUID, $getItem['id']);
        
        // Finally, delete it
        $deleteItem = PromisePay::deleteItem($getItem['id']);
        
        $this->assertNotNull($deleteItem['id']);
        $this->assertEquals($deleteItem['state'], 'cancelled');
    }
    
    public function testEditItem() {
        // Isolate the data for the sake of below tests (as we're going to be modifying it)
        $data = $this->itemData;
        
        // Create the item
        $createItem = PromisePay::createItem($data);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        // Modify data
        $data['name'] = 'Test123Update';
        $data['description'] = 'Test123Description';
        
        // Finally, modify the item
        $updateItem = PromisePay::updateItem($createItem['id'], $data);
        
        $this->assertEquals($data['name'], $updateItem['name']);
        $this->assertEquals($data['description'], $updateItem['description']);
    }
    
    public function testMakePayment() {
        $user_guid = GUID();
        $userData = array(
            'id'            => $user_guid,
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $user_guid . '@google.com',
            'mobile'        => $user_guid . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );
        
        $itemData = $this->itemData;
        $itemData['buyer_id'] = $user_guid;
        
        
        $createUser = PromisePay::createUser($userData);
        
        // Create the item
        $createItem = PromisePay::createItem($itemData);
        
        $makePayment = PromisePay::makePayment($createItem['id'], array('account_id' => $createUser['id']));
        
        var_dump($makePayment);
    }
    
    
    public function testListTransactionsForItem() {
        // Create the item
        PromisePay::createItem($this->itemData);
        
        $listTransactions = PromisePay::getListOfTransactionsForItem($this->GUID);
        
        //var_dump($listTransactions);
        
        /*
        $repo = new ItemRepository();
        $transactions = $repo->getListOfTransactionsForItem("7c269f52-2236-4aa5-899e-a2e3ecadbc3f");
        
        
        $this->assertNotNull($transactions);
        */
    }
    /*
    public function testGetStatusForItem() {
        $repo = new ItemRepository();
        $status = $repo->getItemStatus("7c269f52-2236-4aa5-899e-a2e3ecadbc3f");
        
        $this->assertNotNull($status);
    }
    
    public function testListFeesForItem() {
        $repo = new ItemRepository();
        $fees = $repo->getListFeesForItems("7c269f52-2236-4aa5-899e-a2e3ecadbc3f");
        
        $this->assertNotNull($fees);
    }
    
    public function testGetBuyerForItem() {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        
        $repo = new ItemRepository();
        $user = $repo->getBuyerOfItem("7c269f52-2236-4aa5-899e-a2e3ecadbc3f");
        
        $this->assertNotNull($user);
    }
    
    public function testGetSellerForItem() {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        
        $repo = new ItemRepository();
        $user = $repo->getSellerForItem("7c269f52-2236-4aa5-899e-a2e3ecadbc3f");
        
        $this->assertNotNull($user);
    }
    
    public function testGetWireDetailsForItem() {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        
        $repo = new ItemRepository();
        $wireDetails = $repo->getWireDetailsForItem("7c269f52-2236-4aa5-899e-a2e3ecadbc3f");
        
        $this->assertNotNull($wireDetails);
    }
    
    public function testGetBpayDetailsForItem() {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        
        $repo = new ItemRepository();
        $bpayDetails = $repo->getBPayDetailsForItem("7c269f52-2236-4aa5-899e-a2e3ecadbc3f");
        
        $this->assertNotNull($bpayDetails);
    }
    */
}
