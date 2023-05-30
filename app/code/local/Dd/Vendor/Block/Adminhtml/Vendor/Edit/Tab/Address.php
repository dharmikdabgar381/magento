<?php
class Dd_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$vendorField = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor Address information')));


		$vendorField->addField('address', 'text', array(
            'label' => Mage::helper('vendor')->__('Address'),
            'required' => true,
            'name' => 'vendor_address[address]',
		));

		$vendorField->addField('city', 'text', array(
            'label' => Mage::helper('vendor')->__('City'),
            'required' => true,
            'name' => 'vendor_address[city]',
		));

		$vendorField->addField('state', 'text', array(
            'label' => Mage::helper('vendor')->__('State'),
            'required' => true,
            'name' => 'vendor_address[state]',
		));

		$vendorField->addField('country', 'text', array(
            'label' => Mage::helper('vendor')->__('Country'),
            'required' => true,
            'name' => 'vendor_address[country]',
		));

		$vendorField->addField('zipcode', 'text', array(
            'label' => Mage::helper('vendor')->__('Zipcode'),
            'required' => true,
            'name' => 'vendor_address[zipcode]',
		));

		if ( Mage::getSingleton('adminhtml/session')->getsalesmanData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getsalesmanData());
			Mage::getSingleton('adminhtml/session')->setsalesmanData(null);
		} 
		elseif ( Mage::registry('address_data') ) 
		{
			$form->setValues(Mage::registry('address_data')->getData());
		}
		return parent::_prepareForm();
	}
}
