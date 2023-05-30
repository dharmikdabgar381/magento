<?php
/**
 * 
 */
class Ccc_Category_AdminController extends Mage_Core_Controller_Front_Action
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
		$block = $this->getLayout()->createBlock('category/category');
		$helper = Mage::helper('category/category');
		$helper = Mage::helper('category/data');

		// $this->getLayout();
		$this->renderLayout();
		print_r(get_class_methods('Ccc_Category_IndexController'));
		 
	}

}