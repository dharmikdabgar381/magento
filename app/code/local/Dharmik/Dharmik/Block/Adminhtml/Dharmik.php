<?php 
class Dharmik_Dharmik_Block_Adminhtml_Dharmik extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'dharmik';
        $this->_controller = 'adminhtml_dharmik';
        $this->_headerText = $this->__('Dharmik Grid');
        $this->_addButtonLabel = $this->__('Add Dharmik');
        parent::__construct();
    }
}