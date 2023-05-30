<?php
class Ccc_Product_Block_Adminhtml_Product_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$productField = $form->addFieldset('product_form',array('legend'=>Mage::helper('product')->__('Product information')));


		$productField->addField('name', 'text', array(
            'label' => Mage::helper('product')->__('Product Name'),
            'required' => true,
            'name' => 'name',
		));

		$productField->addField('sku', 'text', array(
            'label' => Mage::helper('product')->__('SKU'),
            'required' => true,
            'name' => 'sku',
		));

		$productField->addField('cost', 'text', array(
            'label' => Mage::helper('product')->__('Cost'),
            'required' => true,
            'name' => 'cost',
		));

		$productField->addField('price', 'text', array(
            'label' => Mage::helper('product')->__('Price'),
            'required' => true,
            'name' => 'price',
		));

		$productField->addField('quantity', 'text', array(
            'label' => Mage::helper('product')->__('Quantity'),
            'required' => true,
            'name' => 'quantity',
		));

		$productField->addField('status', 'select', array(
            'label' => Mage::helper('product')->__('Status'),
            'required' => true,
            'name' => 'status',
            'type' => 'select',
            'options' => array(
            	'1' => Mage::helper('product')->__('Active'),
            	'2' => Mage::helper('product')->__('Inactive')
            )
		));

		$productField->addField('description', 'text', array(
            'label' => Mage::helper('product')->__('Description'),
            'required' => true,
            'name' => 'description',
		));

		if ( Mage::getSingleton('adminhtml/session')->getproductData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getproductData());
			Mage::getSingleton('adminhtml/session')->setproductData(null);
		} 
		elseif ( Mage::registry('product_data') ) 
		{
			$form->setValues(Mage::registry('product_data')->getData());
		}
		return parent::_prepareForm();
	}
}
