<?php

class Ccc_Practice_Adminhtml_QueryController extends Mage_Core_Controller_Front_Action
{
	
	public function indexAction()
	{
		echo "<pre>";
		$resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $product = $resource->getTableName('product/product');
        $idx = $resource->getTableName('idx/idx');

        //Insert Record 
        $write->insert($product,array('name' => 'Cello FlipStyle', 'sku' => 'CFS221W', 'cost' => 500,'price' => 800, 'quantity' => 100, 'status' => 1, 'description' => 'Vacu Steel Bottle'));

        // left join
        $leftJoin = $write->select()
            ->from(['t' => $product], ['product_id', 'status'])
            ->joinLeft(['t2' => $idx], 't.product_id = t2.product_id', ['brand_id','collection_id'])   
            ->group('t2.cost')
            ->where('t.price LIKE ?', "%500%");

        echo "<br>";

        $result = $write->fetchAll($leftJoin);

        //Update Query
        echo 'Update Value :-'.$write->update(
            $product,
            ['sku' => 'CFS22W', 'cost' => 6000],
            ['product_id = ?' => 26]
        );
        echo "<br>";

        //Delete Query

        echo 'Delete Value :-'.$write->delete(
            $product,
            ['product_id IN (?)' => [27]]
        );

        // Insert Multiple:

        $data = [
            ['name' => 'Cello FlipStyle1', 'sku' => 'CFS12W', 'cost' => 600,'price' => 900, 'quantity' => 500, 'status' => 1, 'description' => 'Vacu Steel Bottle'],
            ['name' => 'Cello FlipStyle2', 'sku' => 'CFS21W', 'cost' => 800,'price' => 1000, 'quantity' => 100, 'status' => 2, 'description' => 'Vacu Steel Bottle'],
        ];
        $write->insertMultiple($product, $data);
        
        // Insert Update On Duplicate:

        $data = [];
        $data[] = [
            'sku' => 'CFS21W',
            'cost' => 1500
        ];

        $write->insertOnDuplicate(
            $product,
            $data, 
            ['cost'] 
        );
        
	}
}