<?php 

$this->startSetup();

$this->addEntityType(Dharmik_Dharmik_Model_Resource_Dharmik::ENTITY,[
  'entity_model'=>'dharmik/dharmik',
  'attribute_model'=>'dharmik/attribute',
  'table'=>'dharmik/dharmik',
  'increment_per_store'=> '0',
  'additional_attribute_table' => 'dharmik/eav_attribute',
  'entity_attribute_collection' => 'dharmik/dharmik_attribute_collection'
]);

$this->createEntityTables('dharmik');
$this->installEntities();

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
                ->getAttributeSetId('dharmik', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'dharmik'");

$this->endSetup();
?>