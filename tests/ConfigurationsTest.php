<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class ConfigurationsTest extends \PHPUnit_Framework_TestCase {

    protected $configuration = array(
        'name' => 'partial_refunds',
        'enabled' => true
    );

    protected static $configurationId;

    protected function assertConfiguration(array $response, $skipValues = false) {
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('enabled', $response);

        if ($skipValues)
            return;

        $this->assertEquals($response['name'], $this->configuration['name']);
        $this->assertEquals($response['enabled'], $this->configuration['enabled']);
    }

    public function testCreate() {
        $configuration = PromisePay::Configurations()->create($this->configuration);

        $this->assertConfiguration($configuration);

        self::$configurationId = $configuration['id'];
    }

    public function testGet() {
        $configuration = PromisePay::Configurations()->get(self::$configurationId);

        $this->assertEquals(self::$configurationId, $configuration['id']);
        $this->assertConfiguration($configuration);
    }

    public function testUpdate() {
        $updatedConfigurationSettings = array('id' => self::$configurationId, 'max' => PHP_INT_MAX) + $this->configuration;

        $configuration = PromisePay::Configurations()->update($updatedConfigurationSettings);

        $this->assertConfiguration($configuration);
        $this->assertEquals($updatedConfigurationSettings['max'], $configuration['max']);
    }

    /**
     * @group get-list
     */
    public function testGetList() {
        $configurations = PromisePay::Configurations()->getList();

        $this->assertTrue(is_array($configurations));

        foreach ($configurations as $configuration) {
            $this->assertConfiguration($configuration, true);
        }

        return $configurations;
    }

    public function testDelete($id = null) {
        $id = $id !== null ? $id : self::$configurationId;

        PromisePay::Configurations()->delete($id);

        // test if it's been properly deleted
        $configuration = PromisePay::Configurations()->get($id);

        $this->assertEmpty($configuration);
    }

    public function testDeleteAllPartialPaymentsRestrictions() {
        $configurations = PromisePay::getAllResultsAsync(function($limit, $offset) {
            return PromisePay::Configurations()->getList(array(
                'offset' => 0,
                'limit' => 200
            ));
        });

        foreach ($configurations as $configuration) {
            if ($configuration['name'] == 'partial_refunds') {
                $this->testDelete($configuration['id']);
            }
        }
    }

    private function readmeExamples() {
        // CREATE
        $configuration = PromisePay::Configurations()->create(array(
            'name' => 'partial_refunds',
            'enabled' => true
        ));

        // GET
        $configuration = PromisePay::Configurations()->get('ca321b3f-db87-4d75-ba05-531c7f1bb515');

        // GET LIST
        $configurations = PromisePay::Configurations()->getList();

        // UPDATE
        $configuration = PromisePay::Configurations()->update(array(
            'id' => 'ca321b3f-db87-4d75-ba05-531c7f1bb515',
            'max' => 12345,
            'name' => 'partial_refunds',
            'enabled' => true
        ));

        // DELETE
        PromisePay::Configurations()->delete('ca321b3f-db87-4d75-ba05-531c7f1bb515');
    }

}
