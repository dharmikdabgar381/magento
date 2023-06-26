<?php

class Ccc_Practice_Block_Adminhtml_Eight_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('sales/order_item_collection')
            ->addFieldToSelect(array('product_id', 'sku'));

        $collection->getSelect()
            ->columns(array('sold_quantity' => 'SUM(qty_ordered)'))
            ->group(array('product_id', 'sku'));

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('product_id', array( 
            'header'    => Mage::helper('practice')->__('Product Id'),
            'align'     => 'left',
            'index'     => 'product_id',
        ));

        $this->addColumn('sku', array( 
            'header'    => Mage::helper('practice')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku',
        ));

        $this->addColumn('sold_quantity', array( 
            'header'    => Mage::helper('practice')->__('Sold Quantity'),
            'align'     => 'left',
            'index'     => 'sold_quantity',
        ));

        return parent::_prepareColumns();
    }
}