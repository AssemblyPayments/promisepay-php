<?php
namespace PromisePay\Helpers;

class AsyncStorage {
    
    public $json;
    public $meta;
    public $links;
    public $debug;
    
    public function __construct(array $json, array $meta, array $links, array $debug) {
        $this->json = $json;
        $this->meta = $meta;
        $this->links = $links;
        $this->debug = $debug;
    }
    
    public function getJson($index = null) {
        if ($index !== null)
            return isset($this->json[$index]) ? $this->json[$index] : array();
        
        return $this->json;
    }
    
    public function getMeta($index = null) {
        if ($index !== null)
            return isset($this->meta[$index]) ? $this->meta[$index] : array();
        
        return $this->meta;
    }
    
    public function getLinks($index = null) {
        if ($index !== null)
            return isset($this->links[$index]) ? $this->links[$index] : array();
        
        return $this->links;
    }
    
    public function getDebug($index = null) {
        if ($index !== null)
            return isset($this->debug[$index]) ? $this->debug[$index] : array();
        
        return $this->debug;
    }
    
}

 