<?php
/**
 * 
 */
class Ccc_Product_AdminController extends Mage_Core_Controller_Front_Action
{
	
	function indexAction()
	{
		$this->_title($this->__('Customers'))->_title($this->__('Manage Customers'));
		$this->loadLayout();
		// $this->_setActiveMenu('Product/managevender');
		// $this->_addContent(
        //     $this->getLayout()->createBlock('adminhtml/product', 'product')
        // );

		// $model = Mage::getModel('product/product');
		$block = $this->getLayout()->createBlock('product/Product');
		$helper = Mage::helper('product/product');
		$helper = Mage::helper('product/data');

		// $this->getLayout();
		$this->renderLayout();
		print_r(get_class_methods('Ccc_Product_IndexController'));
		 
	}

}