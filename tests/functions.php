<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

function getAllResults($request, $limit = 200, $offset = 0, $async = false) {
    // can't use callable argument typehint as the 
    // minimal version of PHP we're supporting is 5.3
    
    if (!is_callable($request)) {
        throw new \InvalidArgumentException(
            sprintf(
                '%s requires its first argument to be
                a closure, but %s was given instead.',
                __FUNCTION__,
                gettype($request)
            )
        );
    }
    
    if (!is_int($limit) || !is_int($offset)) {
        throw new \InvalidArgumentException(
            sprintf(
                '%s requires its second and third argument
                to be integers, but %s and %s, respectively,
                were given instead.',
                __FUNCTION__,
                gettype($limit),
                gettype($offset)
            )
        );
    }
    
    $results = array();
    $total = null;
    
    do {
        fwrite(
            STDOUT,
            sprintf(
                "Progress: offset is %d, results count is %d" . PHP_EOL,
                $offset,
                $total
            )
        );
        
        $results = array_merge($results, $request($limit, $offset));
        
        if ($total === null) {
            $meta = PromisePay::getMeta();
            
            $total = isset($meta['total']) ? $meta['total'] : 0;
        }
        
        if ($async) {
            PromisePay::beginAsync();
        }
        
        $offset += $limit;
    } while ($offset < $total);
    
    if ($async) {
        $asyncRequests = PromisePay::AsyncClient();
        $results = array_merge($results, $asyncRequests);
        
        PromisePay::finishAsync();
    }
    
    return $results;
}
