<?php
class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$SalesmanField = $form->addFieldset('salesman_form',array('legend'=>Mage::helper('salesman')->__('Salesman information')));


		$SalesmanField->addField('fname', 'text', array(
            'label' => Mage::helper('salesman')->__('First Name'),
            'required' => true,
            'name' => 'salesman[fname]',
		));

		$SalesmanField->addField('lname', 'text', array(
            'label' => Mage::helper('salesman')->__('Last Name'),
            'required' => true,
            'name' => 'salesman[lname]',
		));

		$SalesmanField->addField('email', 'text', array(
            'label' => Mage::helper('salesman')->__('Email'),
            'required' => true,
            'name' => 'salesman[email]',
		));

		$SalesmanField->addField('mobile', 'text', array(
            'label' => Mage::helper('salesman')->__('Mobile'),
            'required' => true,
            'name' => 'salesman[mobile]',
		));

		$SalesmanField->addField('gender', 'select', array(
            'label' => Mage::helper('salesman')->__('Gender'),
            'required' => true,
            'name' => 'salesman[gender]',
            'type' => 'select',
            'options' => array(
            	'1' => Mage::helper('salesman')->__('Male'),
            	'2' => Mage::helper('salesman')->__('Female'),

            )
		));

		$SalesmanField->addField('status', 'select', array(
            'label' => Mage::helper('salesman')->__('Status'),
            'required' => true,
            'name' => 'salesman[status]',
            'type' => 'select',
            'options' => array(
            	'1' => Mage::helper('salesman')->__('Active'),
            	'2' => Mage::helper('salesman')->__('Inactive'),
            )
		));

		$SalesmanField->addField('company', 'text', array(
            'label' => Mage::helper('salesman')->__('Company'),
            'required' => true,
            'name' => 'salesman[company]',
		));

		if ( Mage::getSingleton('adminhtml/session')->getsalesmanData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getsalesmanData());
			Mage::getSingleton('adminhtml/session')->setsalesmanData(null);
		} 
		elseif ( Mage::registry('salesman_data') ) 
		{
			$form->setValues(Mage::registry('salesman_data')->getData());
		}
		return parent::_prepareForm();
	}
}
