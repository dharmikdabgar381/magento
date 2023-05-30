<?php

class Dharmik_Dharmik_Block_Adminhtml_Dharmik_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'dharmik';
		$this->_controller = 'adminhtml_dharmik_attribute';
		$this->_headerText = Mage::helper('vendor')->__('Manage Attributes');
        $this->_addButtonLabel = Mage::helper('vendor')->__('Add New Attribute');
		parent::__construct();
	}
}