<?php
define('MAGENTO_ROOT', getcwd());

$mageFilename = MAGENTO_ROOT . '/app/Mage.php';

require MAGENTO_ROOT . '/app/bootstrap.php';
require_once $mageFilename;
Mage::setIsDeveloperMode(true);

Mage::app('default');
echo "string";

echo "<pre>";
print_r($model = Mage::getModel('practice/practice')->getCollection()->test()->test2());
// print_r($model = Mage::getModel('practice/practice')->getCollection());
print_r($model);
?>