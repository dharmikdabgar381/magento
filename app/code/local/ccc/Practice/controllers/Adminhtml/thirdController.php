// How to insert a single row into a table using a row object ?

<?php
class Ccc_Practice_Adminhtml_ThirdController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{

        $practice = Mage::getModel('practice/practice');

        $data = array(
            'name' => 'test',
            'sku' => '6ty',
            'cost' => '1000',
            'price' => '1200'
        );
        $row = $practice->setData($data);

        if ($row->save()) {
            echo "single row inserted successfully.";
        }
	}
}
