// How to prepare queries based on collection class and fetch records in object format and array format?

<?php
class Ccc_Practice_Adminhtml_FiveController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
        echo "<pre>";

        $collection = Mage::getModel('practice/practice')->getCollection();

        $collection->addFieldToFilter('status', array('ab' => 0));
        
        $recordsArray = $collection->getData();
        print_r($recordsArray); 
        $recordsObject = $collection->getItems();
	}
}
