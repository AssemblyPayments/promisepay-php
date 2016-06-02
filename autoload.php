<?php
namespace PromisePay;

spl_autoload_register(function ($class) {
    $namespaceLength = strlen(__NAMESPACE__);
    
    if (substr($class, 0, $namespaceLength) != __NAMESPACE__) {
        // doesn't belong to our package
        return;
    }
    
    $classPath = substr($class, $namespaceLength);
    
    $file = __DIR__ . '/lib/' . trim(str_replace('\\', '/', $classPath), '/') . '.php';
    
    if (file_exists($file)) {
        require $file;
    } else {
        die(
            sprintf(
                "%s (path: %s) wasn't found.",
                $class,
                $file
            )
        );
    }
});

require_once __DIR__ . '/lib/Vendors/Httpful/Bootstrap.php';
require_once __DIR__ . '/lib/Vendors/Httpful/Http.php';
require_once __DIR__ . '/lib/Vendors/Httpful/Request.php';