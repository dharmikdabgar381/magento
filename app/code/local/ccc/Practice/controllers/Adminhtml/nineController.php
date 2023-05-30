// Check all methods available in our row class and find out how it works in Magento ?

<?php
class Ccc_Practice_Adminhtml_NineController extends Mage_Core_Controller_Front_Action
{

	public function indexAction()
	{
        $row = Mage::getModel('practice/resource_practice');
        echo "<pre>";
        print_r(get_class_methods($row));
	}
}
