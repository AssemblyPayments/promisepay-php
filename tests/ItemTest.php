<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class ItemTest extends \PHPUnit_Framework_TestCase {
    
    protected $GUID, $buyerId, $sellerId, $itemData, $feeData, $userData, $cardAccountData;
    
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
        
        $this->userData = array(
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
        
        $this->cardAccountData = array(
           'user_id'      => $this->buyerId,
           'full_name'    => null,
           'number'       => '4111111111111111',
           "expiry_month" => '06',
           "expiry_year"  => '2020',
           "cvv"          => '123'
        );
    }
    
    protected function createRandomIds() {
        $this->itemData['id'] = GUID();
        
        $this->buyerId = GUID();
        $this->sellerId = GUID();
        
        $this->itemData['buyer_id'] = $this->buyerId;
        $this->itemData['seller_id'] = $this->sellerId;
    }
    
    protected function createBuyer() {
        $this->userData['id'] = $this->buyerId;
        $this->userData['email'] = $this->buyerId . '@google.com';
        $this->userData['mobile'] = $this->buyerId . '123456';

        return PromisePay::User()->create($this->userData);
    }
    
    protected function createBuyerCardAccount() {
        $this->cardAccountData['user_id'] = $this->buyerId;
        
        $this->cardAccountData['full_name'] = sprintf(
            '%s %s',
            $this->userData['first_name'],
            $this->userData['last_name']
        );
        
        return PromisePay::CardAccount()->create($this->cardAccountData);
    }
    
    protected function createSeller() {
        $this->userData['id'] = $this->sellerId;
        $this->userData['email'] = $this->sellerId . '@google.com';
        $this->userData['mobile'] = $this->sellerId . '12345';
        $this->userData['first_name'] = 'Jane';
        $this->userData['last_name'] = 'Jonesy';
        
        return PromisePay::User()->create($this->userData);
    }
    
    protected function createItem() {
        return PromisePay::Item()->create($this->itemData);
    }
    
    protected function payForItem($itemId, $buyerCardAccountId) {
        return PromisePay::Item()->makePayment(
            $itemId,
            array(
                'account_id' => $buyerCardAccountId
            )
        );
    }
    
    public function makePayment() {
        $this->createRandomIds();
        
        $seller = $this->createSeller();
        $buyer = $this->createBuyer();
        $buyerCard = $this->createBuyerCardAccount();
        $item = $this->createItem();
        $payment = $this->payForItem($item['id'], $buyerCard['id']);
        
        return array(
            'payment' => $payment,
            'item' => $item,
            'buyer' => $buyer,
            'buyer_card' => $buyerCard,
            'seller' => $seller
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
        $makePayment = $this->makePayment();
        
        $this->assertEquals($makePayment['payment']['state'], 'payment_deposited');
    }
    
    public function testListTransactionsForItem() {
        $makePayment = $this->makePayment();
        
        $listTransactions = PromisePay::Item()->getListOfTransactions($makePayment['item']['id']);
        
        $this->assertEquals($this->cardAccountData['full_name'], $listTransactions[0]['user_name']);
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
        
        $this->assertNotEmpty($itemListOfFees[0]['fee_list']);
        
        $this->assertTrue(in_array($createFee['id'], $itemListOfFees[0]['fee_list']));
    }
    
    public function testGetBuyerForItem() {
        $makePayment = $this->makePayment();
        
        $getBuyer = PromisePay::Item()->getBuyer($makePayment['item']['id']);
        $buyerFullName = $getBuyer['first_name'] . ' ' . $getBuyer['last_name'];
        
        $this->assertEquals($getBuyer['first_name'], $makePayment['buyer']['first_name']);
        $this->assertEquals($getBuyer['last_name'], $makePayment['buyer']['last_name']);
        $this->assertEquals($buyerFullName, $makePayment['payment']['buyer_name']);
    }
    
    public function testGetSellerForItem() {
        $makePayment = $this->makePayment();
        
        $getSeller = PromisePay::Item()->getSeller($makePayment['item']['id']);
        $sellerFullName = $getSeller['first_name'] . ' ' . $getSeller['last_name'];
        
        $this->assertEquals($getSeller['first_name'], $makePayment['seller']['first_name']);
        $this->assertEquals($getSeller['last_name'], $makePayment['seller']['last_name']);
        $this->assertEquals($sellerFullName, $makePayment['payment']['seller_name']);
    }
        
    public function testGetWireDetailsForItem() {
        $makePayment = $this->makePayment();
        
        $wireDetails = PromisePay::Item()->getWireDetails($makePayment['item']['id']);
        
        $this->assertTrue(is_array($wireDetails['wire_details']));
        $this->assertEquals($wireDetails['wire_details']['amount'], '$10.00'); // 1000 cents = $10
    }
    
    public function testGetBpayDetailsForItem() {
        $makePayment = $this->makePayment();
        
        $bPayDetails = PromisePay::Item()->getBPayDetails($makePayment['item']['id']);
        
        $this->assertTrue(is_array($bPayDetails['bpay_details']));
        $this->assertEquals($bPayDetails['bpay_details']['amount'], '$10.00'); // 1000 cents = $10
    }
    
    public function testRequestPayment() {
        $item = PromisePay::Item()->create($this->itemData);
        
        $requestPayment = PromisePay::Item()->requestPayment(
            $item['id']
        );
        
        $this->assertEquals($requestPayment['state'], 'payment_required');
    }
    
    
}
