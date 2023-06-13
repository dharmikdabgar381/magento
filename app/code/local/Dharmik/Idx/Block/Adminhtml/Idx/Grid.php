<?php
class Dharmik_Idx_Block_Adminhtml_Idx_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('idxAdminhtmlIdxGrid');
        $this->setDefaultSort(`index`);
        $this->setDefaultDir('ASC');
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField(`index`);
        $this->getMassactionBlock()->setFormFieldName(`index`);
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('idx')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('idx')->__('Are you sure?')
        ));
         
        return $this;
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('idx/idx')->getCollection();
        $this->setCollection($collection);


        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('index', array(
            'header'    => Mage::helper('idx')->__('Index'),
            'align'     => 'left',
            'index'     => 'index',
        ));

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('idx')->__('Product Id'),
            'align'     => 'left',
            'index'     => 'product_id'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('idx')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('idx')->__('Product Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('idx')->__('Price'),
            'align'     => 'left',
            'index'     => 'price'
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('idx')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));

        $this->addColumn('quntity', array(
            'header'    => Mage::helper('idx')->__('Quntity'),
            'align'     => 'left',
            'index'     => 'quntity'
        ));

        $this->addColumn('brand', array(
            'header'    => Mage::helper('idx')->__('Brand'),
            'align'     => 'left',
            'index'     => 'brand'
        ));

        $this->addColumn('brand_id', array(
            'header'    => Mage::helper('idx')->__('Brand ID'),
            'align'     => 'left',
            'index'     => 'brand_id'
        ));

        $this->addColumn('collection', array(
            'header'    => Mage::helper('idx')->__('Collection'),
            'align'     => 'left',
            'index'     => 'collection'
        ));

        $this->addColumn('collection_id', array(
            'header'    => Mage::helper('idx')->__('Collection ID'),
            'align'     => 'left',
            'index'     => 'collection_id'
        ));

        $this->addColumn('description', array(
            'header'    => Mage::helper('idx')->__('Description'),
            'align'     => 'left',
            'index'     => 'description'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('idx')->__('Status'),
            'align'     => 'left',
            'index'     => 'status'
        ));



        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('index' => $row->getId()));
    }
   
}