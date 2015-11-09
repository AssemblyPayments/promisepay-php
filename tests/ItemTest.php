<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class ItemTest extends \PHPUnit_Framework_TestCase {
    
    protected $GUID, $buyerId, $sellerId, $itemData, $feeData;
    
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
        
        // Setup fee data
        $this->feeData = array(
            'amount'      => 6666,
            'name'        => 'fee test TEST123TEST123TEST123',
            'fee_type_id' => '1',
            'cap'         => '1',
            'max'         => '3',
            'min'         => '2',
            'to'          => 'buyer'
        );
    }
    
    public function testCreateItem() {
        $createItem = PromisePay::Item()->create($this->itemData);
        
        $this->assertEquals($this->itemData['id'], $createItem['id']);
        $this->assertEquals($this->itemData['name'], $createItem['name']);
        $this->assertEquals($this->itemData['amount'], $createItem['amount']);
        $this->assertEquals($this->itemData['payment_type_id'], $createItem['payment_type_id']);
        $this->assertEquals($this->itemData['description'], $createItem['description']);
    }
    
    public function testListAllItems() {
        $fetchList = PromisePay::Item()->getList(200);
        
        $this->assertNotNull($fetchList);
        $this->assertTrue(count($fetchList) > 0);
    }
    
    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListItemsNegativeParams() {
        PromisePay::Item()->getList(-10, -20);
    }
    
    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListItemsTooHighLimit() {
        PromisePay::Item()->getList(201);
    }
    
    public function testGetItem() {
        // Create the item
        PromisePay::Item()->create($this->itemData);
        
        // Then, fetch it
        $getItem = PromisePay::Item()->get($this->GUID);

        $this->assertNotNull($getItem);
        $this->assertEquals($this->GUID, $getItem['id']);
    }
    
    public function testDeleteItem() {
        // Create the item
        PromisePay::Item()->create($this->itemData);
        
        // Fetch its data
        $getItem = PromisePay::Item()->get($this->GUID);
        
        $this->assertNotNull($getItem);
        $this->assertEquals($this->GUID, $getItem['id']);
        
        // Finally, delete it
        $deleteItem = PromisePay::Item()->delete($getItem['id']);
        
        $this->assertNotNull($deleteItem['id']);
        $this->assertEquals($deleteItem['state'], 'cancelled');
    }
    
    public function testEditItem() {
        // Isolate the data for the sake of below tests (as we're going to be modifying it)
        $data = $this->itemData;
        
        // Create the item
        $createItem = PromisePay::Item()->create($data);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        // Modify data
        $data['name'] = 'Test123Update';
        $data['description'] = 'Test123Description';
        
        // Finally, modify the item
        $updateItem = PromisePay::Item()->update($createItem['id'], $data);
        
        $this->assertEquals($data['name'], $updateItem['name']);
        $this->assertEquals($data['description'], $updateItem['description']);
    }
    
    public function testMakePayment() {
        $this->buyerId = GUID();
        $this->sellerId = GUID();
        $this->GUID = GUID();
        $userData = array(
            'id'            => $this->buyerId,
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $this->buyerId . '@google.com',
            'mobile'        => $this->buyerId . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );
        
        $cardAccountData = array(
           'user_id'      => $this->buyerId,
           'full_name'    => 'UserCreateTest UserLastname',
           'number'       => '4111111111111111',
           "expiry_month" => '06',
           "expiry_year"  => '2020',
           "cvv"          => '123'
        );
        
        // Create Buyer
        $createBuyer = PromisePay::User()->create($userData);

        // Create Buyer Card Account
        $createBuyerCardAccount = PromisePay::CardAccount()->create($cardAccountData);

        // Create Seller
        $userData['id'] = $this->sellerId;
        $userData['email'] = $this->sellerId . '@google.com';
        $userData['mobile'] = $this->sellerId . '12345';
        $createSeller = PromisePay::User()->create($userData);

        // Update item data
        $itemData = array(
            "id"              => $this->GUID,
            "name"            => 'Test Item #1',
            "amount"          => 1000,
            "payment_type_id" => 1,
            "buyer_id"        => $this->buyerId,
            "seller_id"       => $this->sellerId,
            "description"     => 'Description'
        );
        
        // Create the item
        $createItem = PromisePay::Item()->create($itemData);
        
        $makePayment = PromisePay::Item()->makePayment($createItem['id'], array('account_id' => $createBuyerCardAccount['id']));
        $this->assertEquals($makePayment['state'], 'payment_deposited');
    }
    
    public function testListTransactionsForItem() {
        // Create the item
        $createItem = PromisePay::Item()->create($this->itemData);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        //$listTransactions = PromisePay::Item()->getListOfTransactions($createItem['id']);
        
        // CONTINUE AFTER MAKE PAYMENT ISSUE IS RESOLVED
        //var_dump($listTransactions);
        
        /*
        $repo = new ItemRepository();
        $transactions = $repo->getListOfTransactionsForItem("7c269f52-2236-4aa5-899e-a2e3ecadbc3f");
        
        
        $this->assertNotNull($transactions);
        */
    }
    
    public function testGetStatusForItem() {
        // Create the item
        $createItem = PromisePay::Item()->create($this->itemData);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        // Get its status
        $itemStatus = PromisePay::Item()->getStatus($createItem['id']);
        
        $this->assertNotNull($itemStatus['status']);
    }
    
    public function testListFeesForItem() {
        // Create a fee
        $createFee = PromisePay::Fee()->create($this->feeData);
        
        // Sandbox the item data, since we're gonna be changing it
        $itemData = $this->itemData;
        $itemData['fee_ids'] = $createFee['id'];
        
        // Create an item containing the fee created above
        $createItem = PromisePay::Item()->create($itemData);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        // Get list of fees
        $itemListOfFees = PromisePay::Item()->getListOfFees($createItem['id']);
        
        //var_dump($itemData, $createItem, $itemListOfFees);
        
        //$this->assertNotNull($itemStatus['fee_list']);
    }
    
    public function testGetBuyerForItem() {
        // Create an item
        $createItem = PromisePay::Item()->create($this->itemData);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        $getBuyer = PromisePay::Item()->getBuyer($createItem['id']);
        
        //var_dump($getBuyer);
        
        $this->assertNotNull($getBuyer);
    }
    
    
    public function testGetSellerForItem() {
        // Create an item
        $createItem = PromisePay::Item()->create($this->itemData);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        // Fetch the seller
        $getSeller = PromisePay::Item()->getSeller($createItem['id']);
        
        //var_dump($getSeller);
        
        $this->assertNotNull($getSeller);
    }
    
    
    public function testGetWireDetailsForItem() {
        // Create an item
        $createItem = PromisePay::Item()->create($this->itemData);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        $wireDetails = PromisePay::Item()->getWireDetails($createItem['id']);
        
        $this->assertTrue(is_array($wireDetails['wire_details']));
    }    
    
    public function testGetBpayDetailsForItem() {
        // Create an item
        $createItem = PromisePay::Item()->create($this->itemData);
        
        $this->assertEquals($this->GUID, $createItem['id']);
        
        $bPayDetails = PromisePay::Item()->getBPayDetails($createItem['id']);
        
        $this->assertTrue(is_array($bPayDetails['bpay_details']));
    }
}
