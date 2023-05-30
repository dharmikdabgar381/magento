<?php

class Dharmik_Dharmik_Model_Attribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Dharmik_Dharmik';
    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('dharmik/attribute');
    }
}