<?php
class Ccc_Category_Block_Adminhtml_Category_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$categoryField = $form->addFieldset('category_form',array('legend'=>Mage::helper('category')->__('Category information')));


		$categoryField->addField('name', 'text', array(
            'label' => Mage::helper('category')->__('Category Name'),
            'required' => true,
            'name' => 'name',
		));

		$categoryField->addField('status', 'select', array(
            'label' => Mage::helper('category')->__('Status'),
            'required' => true,
            'name' => 'status',
            'type' => 'select',
            'options' => array(
            	'1' => Mage::helper('category')->__('Active'),
            	'2' => Mage::helper('category')->__('Inactive')
            )
		));

		$categoryField->addField('description', 'text', array(
            'label' => Mage::helper('category')->__('Description'),
            'required' => true,
            'name' => 'description',
		));

		if ( Mage::getSingleton('adminhtml/session')->getcategoryData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getcategoryData());
			Mage::getSingleton('adminhtml/session')->setcategoryData(null);
		} 
		elseif ( Mage::registry('category_data') ) 
		{
			$form->setValues(Mage::registry('category_data')->getData());
		}
		return parent::_prepareForm();
	}
}
