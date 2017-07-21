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
        $enabled = ['true', 'disabled'];

        foreach (self::OBJECT_TYPES as $type) {
            $params = self::PARAMS;
            $params['description'] = sprintf(self::DESCRIPTION_TEMPLATE, $type);
            $params['url'] = self::URL;
            $params['object_type'] = $type;
            $params['enabled'] = $enabled[array_rand($enabled)];

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
        $params['enabled'] = !$createdCallback['enabled']; // invert previously set enabled state

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

    public function testDelete() {
        $deletedCount = 0;

        foreach (self::$createdCallbacks as $callback) {
            $delete = PromisePay::Callbacks()->delete($callback['id']);
            $deletedCount++;

            $this->assertEquals($delete, 'Successfully redacted');
        }

        $this->assertEquals($deletedCount, count(self::$createdCallbacks));
    }

    public function testGetListResponses() {
        // @TODO
    }

    public function testGetResponse() {
        // @TODO
    }

    protected function getRandomCreatedCallback() {
        return self::$createdCallbacks[array_rand(self::$createdCallbacks)];
    }
}