<?php
class Dharmik_Dharmik_Block_Adminhtml_Dharmik_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{	
	public function __construct()
	{		
		$this->_blockGroup = 'dharmik';
        $this->_controller = 'adminhtml_dharmik';
        $this->_headerText = 'Add Dharmik';
        parent::__construct();
        if(!$this->getRequest()->getParam('set') && !$this->getRequest()->getParam('id'))
		{
			$this->_removeButton('save');
		} 
	}
}