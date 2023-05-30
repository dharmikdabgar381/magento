<?php
class Dharmik_Dharmik_Model_Resource_Dharmik_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
    public function __construct()
    {
        $this->setEntity('dharmik');
        parent::__construct();  
    }
}