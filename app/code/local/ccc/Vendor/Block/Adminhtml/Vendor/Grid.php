<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('vendorAdminhtmlVendorGrid');
        $this->setDefaultSort('vendor_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('vendor')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('vendor')->__('Are you sure?')
        ));


    $this->getMassactionBlock()->addItem('status', array(
        'label' => Mage::helper('vendor')->__('Change Status'),
        'url' => $this->getUrl('*/*/massStatus'),
        'additional' => array(
            'status' => array(
                'name' => 'status',
                'type' => 'select',
                'class' => 'required-entry',
                'label' => Mage::helper('vendor')->__('Status'),
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('vendor')->__('Active'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('vendor')->__('Not Active'),
                    ),
                ),
            ),
        ),
    ));
         
        return $this;
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('vendor/vendor')->getCollection();
        $collection->getSelect()->joinLeft(
        array('address' => $collection->getTable('vendor/vendor_address')),
        'main_table.vendor_id = address.vendor_id',
        array('address', 'postal_code', 'city', 'state', 'country')
    );
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('vendor_id', array(
            'header' => Mage::helper('vendor')->__('Vendor ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'vendor_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('vendor')->__('Name'),
            'index' => 'name',
        ));

        $this->addColumn('email', array(
            'header' => Mage::helper('vendor')->__('Email'),
            'index' => 'email',
        ));

        $this->addColumn('mobile', array(
            'header' => Mage::helper('vendor')->__('Mobile'),
            'index' => 'mobile',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('vendor')->__('Status'),
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => Mage::helper('vendor')->__('Active'),
                0 => Mage::helper('vendor')->__('Not Active'),
            ),
        ));

       
        $this->addColumn('address', array(
            'header' => Mage::helper('vendor')->__('Address'),
            'index' => 'address',
            // 'renderer' => 'Ccc_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_Address',
        ));

        $this->addColumn('postal_code', array(
            'header' => Mage::helper('vendor')->__('Postal Code'),
            'index' => 'postal_code',
        ));

        $this->addColumn('city', array(
            'header' => Mage::helper('vendor')->__('City'),
            'index' => 'city',
        ));

        $this->addColumn('state', array(
            'header' => Mage::helper('vendor')->__('State'),
            'index' => 'state',
            'renderer' => 'Ccc_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_State',
        ));

        $this->addColumn('country', array(
            'header' => Mage::helper('vendor')->__('Country'),
            'index' => 'country',
            'renderer' => 'Ccc_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_Country',
        ));

         $this->addColumn('created_at', array(
            'header' => Mage::helper('vendor')->__('Created At'),
            'index' => 'created_at',
            'type' => 'datetime',
        ));

        $this->addColumn('updated_at', array(
            'header' => Mage::helper('vendor')->__('Updated At'),
            'index' => 'updated_at',
            'type' => 'datetime',
        ));



        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('vendor_id' => $row->getId()));
    }
   
}