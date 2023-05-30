<?php 
class Dharmik_Dharmik_Model_Resource_Dharmik extends Mage_Eav_Model_Entity_Abstract
{
    const ENTITY = 'dharmik';
    public function __construct()
    {
        $this->setType(self::ENTITY)
             ->setConnection('core_read', 'core_write');
       parent::__construct();
    }
}