// How to prepare queries based on SQL SELECT class and fetch records in object format and array format?

<?php
class Ccc_Practice_Adminhtml_SixController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{

        $select = Mage::getSingleton('core/resource')->getConnection('core_read')->select();

        $select->from('practice', array('practice_id', 'name', 'sku', 'status'))
               ->where('status = ?', '0')
               ->order('practice_id ASC')
               ->limit(4);

        $recordsArray = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchAll($select);
        echo "<pre>";

        $recordsObject = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchAll($select, array(), Zend_Db::FETCH_OBJ);
        print_r($recordsObject);
	}
}
