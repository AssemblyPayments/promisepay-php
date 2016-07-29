<?php
namespace PromisePay\Helpers;

class AsyncStorage implements \ArrayAccess, \Iterator {
    
    public $json;
    public $meta;
    public $links;
    public $debug;
    
    private $iteratorPosition;
    
    public function __construct(array $json, array $meta, array $links, array $debug) {
        $this->json = $json;
        $this->meta = $meta;
        $this->links = $links;
        $this->debug = $debug;
        
        $this->iteratorPosition = 0;
    }
    
    // json/meta/links and debug getters
    public function getJson($index = null) {
        if ($index !== null)
            return isset($this->json[$index]) ? $this->json[$index] : null;
        
        return $this->json;
    }
    
    public function getMeta($index = null) {
        if ($index !== null)
            return isset($this->meta[$index]) ? $this->meta[$index] : null;
        
        return $this->meta;
    }
    
    public function getLinks($index = null) {
        if ($index !== null)
            return isset($this->links[$index]) ? $this->links[$index] : null;
        
        return $this->links;
    }
    
    public function getDebug($index = null) {
        if ($index !== null)
            return isset($this->debug[$index]) ? $this->debug[$index] : null;
        
        return $this->debug;
    }
    
    // the next 4 methods are needed by ArrayAccess interface
    public function offsetSet($offset, $value) {
        if (is_null($offset))
            $this->json[$offset] = $value;
        else
            $this->json[] = $value;
    }
    
    public function offsetExists($offset) {
        return isset($this->json[$offset]);
    }
    
    public function offsetUnset($offset) {
        unset($this->json[$offset]);
    }
    
    public function offsetGet($offset) {
        return isset($this->json[$offset]) ? $this->json[$offset] : null;
    }
    
    // the next 5 methods are needed by Iterator interface
    public function rewind() {
        $this->iteratorPosition = 0;
    }
    
    public function current() {
        return $this->json[$this->iteratorPosition];
    }
    
    public function key() {
        return $this->iteratorPosition;
    }
    
    public function next() {
        ++$this->iteratorPosition;
    }
    
    public function valid() {
        return isset($this->json[$this->iteratorPosition]);
    }
    
}
