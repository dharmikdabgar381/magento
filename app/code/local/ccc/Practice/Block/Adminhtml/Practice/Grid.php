<?php
class Ccc_Practice_Block_Adminhtml_Practice_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
        $this->setDefaultSort('practice_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('practice_id');
        $this->getMassactionBlock()->setFormFieldName('practice_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('practice')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('practice')->__('Are you sure?')
        ));
         
        return $this;
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('practice/practice')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('practice_id', array(
            'header'    => Mage::helper('practice')->__('practice Id'),
            'align'     => 'left',
            'index'     => 'practice_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('practice')->__('Practice Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('practice')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('practice')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('practice')->__('Price'),
            'align'     => 'left',
            'index'     => 'price'
        ));

        $this->addColumn('quantity', array(
            'header'    => Mage::helper('practice')->__('Quantity'),
            'align'     => 'left',
            'index'     => 'quantity'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('practice')->__('status'),
            'align'     => 'left',
            'index'     => 'status'
        ));

        $this->addColumn('description', array(
            'header'    => Mage::helper('practice')->__('Description'),
            'align'     => 'left',
            'index'     => 'description'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('practice_id' => $row->getId()));
    }
   
}