<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class MarketplacesTest extends \PHPUnit_Framework_TestCase {
    
    public function testShow() {
        $marketplaces = PromisePay::Marketplaces()->show();
        
        $this->assertNotNull($marketplaces);
        $this->assertNotNull($marketplaces['id']);
        $this->assertNotNull($marketplaces['name']);
    }
    
}
