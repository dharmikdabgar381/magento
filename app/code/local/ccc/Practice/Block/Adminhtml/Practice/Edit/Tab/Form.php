<?php
class Ccc_Practice_Block_Adminhtml_Practice_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$practiceField = $form->addFieldset('practice_form',array('legend'=>Mage::helper('practice')->__('Practice information')));


		$practiceField->addField('name', 'text', array(
            'label' => Mage::helper('practice')->__('Practice Name'),
            'required' => true,
            'name' => 'name',
		));

		$practiceField->addField('sku', 'text', array(
            'label' => Mage::helper('practice')->__('SKU'),
            'required' => true,
            'name' => 'sku',
		));

		$practiceField->addField('cost', 'text', array(
            'label' => Mage::helper('practice')->__('Cost'),
            'required' => true,
            'name' => 'cost',
		));

		$practiceField->addField('price', 'text', array(
            'label' => Mage::helper('practice')->__('Price'),
            'required' => true,
            'name' => 'price',
		));

		$practiceField->addField('quantity', 'text', array(
            'label' => Mage::helper('practice')->__('Quantity'),
            'required' => true,
            'name' => 'quantity',
		));

		$practiceField->addField('status', 'select', array(
            'label' => Mage::helper('practice')->__('Status'),
            'required' => true,
            'name' => 'status',
            'type' => 'select',
            'options' => array(
            	'1' => Mage::helper('practice')->__('Active'),
            	'2' => Mage::helper('practice')->__('Inactive')
            )
		));

		$practiceField->addField('description', 'text', array(
            'label' => Mage::helper('practice')->__('Description'),
            'required' => true,
            'name' => 'description',
		));

		if ( Mage::getSingleton('adminhtml/session')->getpracticeData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getpracticeData());
			Mage::getSingleton('adminhtml/session')->setpracticeData(null);
		} 
		elseif ( Mage::registry('practice_data') ) 
		{
			$form->setValues(Mage::registry('practice_data')->getData());
		}
		return parent::_prepareForm();
	}
}
