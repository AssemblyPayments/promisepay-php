<?php
namespace PromisePay;

include_once 'Configuration.php';
include_once 'Exception\Credentials.php';
include_once 'Exception\Base.php';

$test = new Configuration;

var_dump($test->getUserLogin());