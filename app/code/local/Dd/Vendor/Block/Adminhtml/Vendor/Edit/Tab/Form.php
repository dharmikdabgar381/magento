<?php
class Dd_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$vendorField = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor information')));


		$vendorField->addField('fname', 'text', array(
            'label' => Mage::helper('vendor')->__('First Name'),
            'required' => true,
            'name' => 'vendor[fname]',
		));

		$vendorField->addField('lname', 'text', array(
            'label' => Mage::helper('vendor')->__('Last Name'),
            'required' => true,
            'name' => 'vendor[lname]',
		));

		$vendorField->addField('email', 'text', array(
            'label' => Mage::helper('vendor')->__('Email'),
            'required' => true,
            'name' => 'vendor[email]',
		));

		$vendorField->addField('mobile', 'text', array(
            'label' => Mage::helper('vendor')->__('Mobile'),
            'required' => true,
            'name' => 'vendor[mobile]',
		));

		$vendorField->addField('gender', 'select', array(
            'label' => Mage::helper('vendor')->__('Gender'),
            'required' => true,
            'name' => 'vendor[gender]',
            'type' => 'select',
            'options' => array(
            	'1' => Mage::helper('vendor')->__('Male'),
            	'2' => Mage::helper('vendor')->__('Female'),

            )
		));

		$vendorField->addField('status', 'select', array(
            'label' => Mage::helper('vendor')->__('Status'),
            'required' => true,
            'name' => 'vendor[status]',
            'type' => 'select',
            'options' => array(
            	'1' => Mage::helper('vendor')->__('Active'),
            	'2' => Mage::helper('vendor')->__('Inactive'),
            )
		));

		$vendorField->addField('company', 'text', array(
            'label' => Mage::helper('vendor')->__('Company'),
            'required' => true,
            'name' => 'vendor[company]',
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
