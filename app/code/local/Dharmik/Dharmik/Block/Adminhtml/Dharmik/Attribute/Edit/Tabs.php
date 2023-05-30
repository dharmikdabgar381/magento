<?php

class Dharmik_Dharmik_Block_Adminhtml_Dharmik_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('dharmik_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('dharmik')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label'     => Mage::helper('dharmik')->__('Properties'),
            'title'     => Mage::helper('dharmik')->__('Properties'),
            'content'   => $this->getLayout()->createBlock('dharmik/adminhtml_dharmik_attribute_edit_tab_main')->toHtml(),
            'active'    => true
        ));

        $model = Mage::registry('entity_attribute');

        $this->addTab('labels', array(
            'label'     => Mage::helper('dharmik')->__('Manage Label / Options'),
            'title'     => Mage::helper('dharmik')->__('Manage Label / Options'),
            'content'   => $this->getLayout()->createBlock('dharmik/adminhtml_dharmik_attribute_edit_tab_options')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}