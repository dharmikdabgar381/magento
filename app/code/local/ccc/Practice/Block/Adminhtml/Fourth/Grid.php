<?php
class Ccc_Practice_Block_Adminhtml_Fourth_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('queryAdminhtmlQueryGrid');
    }


     protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->addAttributeToSelect('sku');
        $collection->addAttributeToSelect('image');
        $collection->addAttributeToSelect('small_image');
        $collection->addAttributeToSelect('thumbnail');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header' => 'Product ID',
            'index' => 'entity_id',
            'type' => 'number'
        ));

        $this->addColumn('sku', array(
            'header' => 'SKU',
            'index' => 'sku'
        ));

        $this->addColumn('image', array(
            'header' => 'Base Image',
            'index' => 'image',
            'renderer' => 'Ccc_Practice_Block_Adminhtml_Renderer_ProductImage',
        ));

        $this->addColumn('small_image', array(
            'header' => 'Small Image',
            'index' => 'small_image',
            'renderer' => 'Ccc_Practice_Block_Adminhtml_Renderer_ProductImage',
        ));

        $this->addColumn('thumbnail', array(
            'header' => 'Thumbnail',
            'index' => 'thumbnail',
            'renderer' => 'Ccc_Practice_Block_Adminhtml_Renderer_ProductImage',
        ));

        return parent::_prepareColumns();
    }


}