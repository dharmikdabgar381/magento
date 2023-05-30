// Check all methods available in our adapter class and find out how it works in Magento ?

<?php
class Ccc_Practice_Adminhtml_SevenController extends Mage_Core_Controller_Front_Action
{

	public function indexAction()
	{
        $adapter = Mage::getSingleton('core/resource')->getConnection('core_read');
        echo "<pre>";
        print_r(get_class_methods($adapter));

        $sql = "SELECT * FROM `practice`";
        $bind = array('complete');
        $practicies = $adapter->fetchAll($sql, $bind);
        print_r($practicies);
	}
}
