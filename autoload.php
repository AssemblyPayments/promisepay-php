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

// Was the package installed through Composer?
$composerAutoloadFile = __DIR__ . '/../../../autoload.php';
$vendorFiles = array(
    __DIR__ . '/lib/Vendors/Httpful/Bootstrap.php',
    __DIR__ . '/lib/Vendors/Httpful/Http.php',
    __DIR__ . '/lib/Vendors/Httpful/Request.php'
);

// Prefer Composer installs
if (!is_file($composerAutoloadFile) || !class_exists('\Httpful\Request')) {
    var_dump(
        "NOT USING COMPOSER AUTOLOAD",
        $composerAutoloadFile,
        is_file($composerAutoloadFile),
        class_exists('\Httpful\Request')
    );
    
    foreach ($vendorFiles as $file) {
        require_once $file;
    }
} else {
    var_dump(
        "NOT USING COMPOSER AUTOLOAD",
        $composerAutoloadFile,
        is_file($composerAutoloadFile),
        class_exists('\Httpful\Request')
    );
}