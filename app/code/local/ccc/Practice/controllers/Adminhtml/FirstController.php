// How you will prepare different types of queries and take a collection of rows in  object format and array format

<?php
class Ccc_Practice_Adminhtml_FirstController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";

        $collection = Mage::getModel('practice/practice')->getCollection();

        $collectionArray = $collection->toArray();
        print_r($collectionArray);
        

        $adapter = Mage::getSingleton('core/resource')->getConnection('core_read');
        $select = $adapter->select()
            ->from('practice', array('name', 'cost', 'price'))
            ->where('name = ?', 'practice1');
        $rows = $adapter->fetchAll($select);

        print_r($rows);
    }
}
