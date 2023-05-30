<?php 

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addKey($installer->getTable('dharmik/dharmik_decimal'),
    'UNQ_Dharmik_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('dharmik/dharmik_datetime'),
    'UNQ_Dharmik_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('dharmik/dharmik_int'),
    'UNQ_Dharmik_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('dharmik/dharmik_text'),
    'UNQ_Dharmik_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->endSetup();

?>