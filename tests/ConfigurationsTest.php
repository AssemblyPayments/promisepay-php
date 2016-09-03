<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class ConfigurationsTest extends \PHPUnit_Framework_TestCase {

    protected $configuration = array(
        'name' => 'partial_refunds',
        'enabled' => false
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

    public function testGetList() {
        $configurations = PromisePay::Configurations()->getList();

        $this->assertTrue(is_array($configurations));

        foreach ($configurations as $configuration) {
            $this->assertConfiguration($configuration, true);
        }
    }

    public function testDelete() {
        PromisePay::Configurations()->delete(self::$configurationId);

        // test if it's been properly deleted
        $configuration = PromisePay::Configurations()->get(self::$configurationId);

        $this->assertEmpty($configuration);
    }

}