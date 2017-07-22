<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class CallbacksTest extends \PHPUnit_Framework_TestCase {
    const PARAMS = [
        'description' => null,
        'url' => null,
        'object_type' => null,
        'enabled' => null
    ];
    const OBJECT_TYPES = [
        'items',
        'users',
        'companies',
        'addresses',
        'accounts',
        'disbursements',
        'transactions',
        'batch_transactions'
    ];
    const DESCRIPTION_TEMPLATE = 'Callback for %s (created as a test in PHP SDK)';
    const URL = 'https://httpbin.org/post';

    protected static $createdCallbacks; // populated in testCreate()
    protected static $allCallbacks; // populated in testGetList()

    public function testCreate() {
        // create a callback for each object_type possible,
        // but set enable => false because there can only be one callback
        // enabled for each object_type
        foreach (self::OBJECT_TYPES as $type) {
            $params = self::PARAMS;
            $params['description'] = sprintf(self::DESCRIPTION_TEMPLATE, $type);
            $params['url'] = self::URL;
            $params['object_type'] = $type;
            $params['enabled'] = false;

            $callback = PromisePay::Callbacks()->create($params);
            self::$createdCallbacks[$callback['id']] = $callback;

            $this->assertArrayHasKey('id', $callback);
            $this->assertEquals($callback['description'], $params['description']);
            $this->assertEquals($callback['url'], self::URL);
            $this->assertEquals($callback['object_type'], $type);
        }
    }

    public function testGetList() {
        $callbacks = self::$allCallbacks = PromisePay::getAllResults(function($limit, $offset) {
            return PromisePay::Callbacks()->getList([
                'limit' => $limit,
                'offset' => $offset
            ]);
        });

        // make sure that IDs created using testCreate()
        // are contained in $callbacks
        $createdIds = array_column(self::$createdCallbacks, 'id');
        $getListIds = array_column($callbacks, 'id');

        foreach ($createdIds as $createdId) {
            $inArray = in_array($createdId, $getListIds);

            if (!$inArray)
                fwrite(STDERR, print_r([$createdId, $getListIds], true));

            $this->assertTrue($inArray);
        }
    }

    public function testGet() {
        // take a random ID out of the ones we've created and get it
        $createdCallback = $this->getRandomCreatedCallback();
        $getCallback = PromisePay::Callbacks()->get($createdCallback['id']);

        // make sure that all properties we've set when creating
        // this callback are equal to the ones present
        foreach (self::PARAMS as $param => $placeholderValue) {
            $this->assertEquals($createdCallback[$param], $getCallback[$param]);
        }
    }

    public function testUpdate() {
        $createdCallback = $this->getRandomCreatedCallback();
        $params = self::PARAMS;
        $params['description'] = self::DESCRIPTION_TEMPLATE . ' (UPDATED)';
        $params['url'] = self::URL;
        $params['object_type'] = self::OBJECT_TYPES[array_rand(self::OBJECT_TYPES)];

        $update = PromisePay::Callbacks()->update($createdCallback['id'], $params);

        // check if $update matches $params,
        // except for description, which cannot be changed
        foreach ($params as $key => $value) {
            if ($key == 'description')
                $this->assertNotEquals($value, $update[$key]);
            else
                $this->assertEquals($value, $update[$key]);
        }
    }

    public function testDeleteAnyEnabledCallback() {
        $allCallbacksEnabledColumn = array_column(self::$allCallbacks, 'enabled', 'id');
        $enabledCallbacksIds = array_keys($allCallbacksEnabledColumn, true, true);

        foreach ($enabledCallbacksIds as $enabledCallbackId) {
            $delete = PromisePay::Callbacks()->delete($enabledCallbackId);
            $this->assertEquals($delete, 'Successfully redacted');
        }
    }

    public function testGetListResponses() {
        // enable a user callback.
        // create a user,
        // update a user,
        // check callback responses

        // find a callback we created in testCreate() with object_type = users
        $id = array_search(
            'users',
            array_column(self::$createdCallbacks, 'object_type', 'id')
        );

        // update its enabled property, set it to true
        $updateEnableUserCallbacks = PromisePay::Callbacks()->update($id, ['enabled' => true]);
        $this->assertEquals($updateEnableUserCallbacks['enabled'], true);
        $this->assertEquals($updateEnableUserCallbacks['id'], $id);

        // create and update a user
        require_once __DIR__ . '/UserTest.php'; // @TODO register an inter-devel autoloading
        $userTest = new UserTest();
        $userTest->setUp();
        $userData = $userTest->getUserData();

        // create user
        $createUser = PromisePay::User()->create($userData);
        $createdUserId = $createUser['id'];

        // update user data with a new name
        $updatedUserData = $userData;
        $updatedUserData['first_name'] = 'Claude';
        $updatedUserData['last_name'] = 'Shannon';
        $updateUser = PromisePay::User()->update($createdUserId, $updatedUserData);

        // check callback response
        $callbackResponsesList = PromisePay::Callbacks()->getListResponses($id);

        $this->assertTrue(is_array($callbackResponsesList));

        foreach ($callbackResponsesList as $response) {
            $this->assertArrayHasKey('id', $response);
            $this->assertArrayHasKey('url', $response);
        }
    }

    public function testGetResponse() {
        // @TODO
    }

    public function testDelete() {
        $deletedCount = 0;

        // delete all callbacks
        foreach (self::$createdCallbacks as $callback) {
            $delete = PromisePay::Callbacks()->delete($callback['id']);
            $deletedCount++;

            $this->assertEquals($delete, 'Successfully redacted');
        }

        $this->assertEquals($deletedCount, count(self::$createdCallbacks));
    }

    protected function getRandomCreatedCallback() {
        return self::$createdCallbacks[array_rand(self::$createdCallbacks)];
    }
}