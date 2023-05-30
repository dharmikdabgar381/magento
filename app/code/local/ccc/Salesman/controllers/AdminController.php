<?php
/**
 * 
 */
class Ccc_Salesman_AdminController extends Mage_Core_Controller_Front_Action
{
	
	function indexAction()
	{
		$this->_title($this->__('Customers'))->_title($this->__('Manage Customers'));
		$this->loadLayout();
		// $this->_setActiveMenu('vendor/managevender');
		// $this->_addContent(
        //     $this->getLayout()->createBlock('adminhtml/vendor', 'vendor')
        // );

		// $model = Mage::getModel('vendor/Vendor');
		$block = $this->getLayout()->createBlock('salesman/salesman');
		$helper = Mage::helper('salesman/salesman');
		$helper = Mage::helper('salesman/data');

		// $this->getLayout();
		$this->renderLayout();
		print_r(get_class_methods('Ccc_Salesman_IndexController'));
		 
	}

}