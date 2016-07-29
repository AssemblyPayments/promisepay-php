<?php
namespace PromisePay\Helpers;

class AsyncStorageHandler {
    
    private $json = array();
    private $meta = array();
    private $links = array();
    private $debug = array();
    
    public function storeJson(array $response) {
        $this->json[] = $response;
    }
    
    public function storeMeta(array $meta) {
        $this->meta[] = $meta;
    }
    
    public function storeLinks(array $links) {
        $this->links[] = $links;
    }
    
    public function storeDebug(array $debug) {
        $this->debug[] = $debug;
    }
    
    public function done(
        &$arg0 = null,
        &$arg1 = null,
        &$arg2 = null,
        &$arg3 = null,
        &$arg4 = null,
        &$arg5 = null,
        &$arg6 = null,
        &$arg7 = null,
        &$arg8 = null,
        &$arg9 = null,
        &$arg10 = null,
        &$arg11 = null,
        &$arg12 = null,
        &$arg13 = null,
        &$arg14 = null,
        &$arg15 = null,
        &$arg16 = null,
        &$arg17 = null,
        &$arg18 = null,
        &$arg19 = null,
        &$arg20 = null,
        &$arg21 = null,
        &$arg22 = null,
        &$arg23 = null,
        &$arg24 = null
    ) {
        $argCount = func_num_args();
        $maxArgCount = 25;
        
        if ($argCount > $maxArgCount) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s method supports up to %d parameters, but %d were given instead.' . PHP_EOL,
                    __METHOD__,
                    $maxArgCount,
                    $argCount
                )
            );
        }
        
        $jsonCount = count($this->json);
        
        if ($argCount > $jsonCount) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Too much args supplied to %s; %d were requsted, %d are available.",
                    __METHOD__,
                    $argCount,
                    $jsonCount
                )
            );
        }
        
        for ($i = 0; $i < $argCount; $i++) {
            $paramName = "arg$i";
            
            $$paramName = new AsyncStorage(
                $this->json[$i],
                $this->meta[$i],
                $this->links[$i],
                $this->debug[$i]
            );
        }
    }
}