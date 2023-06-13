<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$vendorField = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor information')));


		$vendorField->addField('name', 'text', array(
            'label' => Mage::helper('vendor')->__('Name'),
            'required' => true,
            'name' => 'vendor[name]',
		));

		$vendorField->addField('email', 'text', array(
            'label' => Mage::helper('vendor')->__('Email'),
            'required' => true,
            'name' => 'vendor[email]',
		));

		$vendorField->addField('password', 'text', array(
            'label' => Mage::helper('vendor')->__('Password'),
            'required' => true,
            'name' => 'vendor[password]',
		));

		$vendorField->addField('mobile', 'text', array(
            'label' => Mage::helper('vendor')->__('Mobile'),
            'required' => true,
            'name' => 'vendor[mobile]',
		));

		$vendorField->addField('status', 'select', array(
            'label' => Mage::helper('vendor')->__('Status'),
            'name' => 'vendor[status]',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('vendor')->__('Active'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('vendor')->__('Not Active'),
                ),
            ),
        ));

		if ( Mage::getSingleton('adminhtml/session')->getvendorData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getvendorData());
			Mage::getSingleton('adminhtml/session')->setvendorData(null);
		} 
		elseif ( Mage::registry('vendor_data') ) 
		{
			$form->setValues(Mage::registry('vendor_data')->getData());
		}
		return parent::_prepareForm();
	}
}
