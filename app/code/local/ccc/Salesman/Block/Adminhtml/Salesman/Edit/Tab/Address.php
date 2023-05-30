<?php
class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$salesmanField = $form->addFieldset('salesman_form',array('legend'=>Mage::helper('salesman')->__('Salesman Address information')));


		$salesmanField->addField('address', 'text', array(
            'label' => Mage::helper('salesman')->__('Address'),
            'required' => true,
            'name' => 'salesman_address[address]',
		));

		$salesmanField->addField('city', 'text', array(
            'label' => Mage::helper('salesman')->__('City'),
            'required' => true,
            'name' => 'salesman_address[city]',
		));

		$salesmanField->addField('state', 'text', array(
            'label' => Mage::helper('salesman')->__('State'),
            'required' => true,
            'name' => 'salesman_address[state]',
		));

		$salesmanField->addField('country', 'text', array(
            'label' => Mage::helper('salesman')->__('Country'),
            'required' => true,
            'name' => 'salesman_address[country]',
		));

		$salesmanField->addField('zipcode', 'text', array(
            'label' => Mage::helper('salesman')->__('Zipcode'),
            'required' => true,
            'name' => 'salesman_address[zipcode]',
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
