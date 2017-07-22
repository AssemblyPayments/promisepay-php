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
        printf("%s (path: %s) wasn't found." . PHP_EOL, $class, $file);
        
        printf(
            'Debug backtrace: %s' . PHP_EOL,
            print_r(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS), true)
        );
        
        die();
    }
});

// Was the package installed through Composer?
// If not, fallback to included versions of vendor files
$httpfulFiles = array(
    __DIR__ . '/lib/Vendors/Httpful/Bootstrap.php',
    __DIR__ . '/lib/Vendors/Httpful/Http.php',
    __DIR__ . '/lib/Vendors/Httpful/Request.php'
);

if (!class_exists('Httpful\Request')) {
    foreach ($httpfulFiles as $file) {
        require_once $file;
    }

    // polyfill for array_column
    require_once __DIR__ . '/lib/Vendors/ramsey/array_column/src/array_column.php';
}