<?php

class Dharmik_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
     protected function _prepareColumns()
    {
        $this->addColumn('index', array(
            'header' => Mage::helper('eavmgmt')->__('Index'),
            'index'  => 'entity_id',
            'renderer'=> 'Dharmik_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv_Number'
        ));

        $this->addColumn('attribute_id', array(
            'header'=>Mage::helper('eavmgmt')->__('Attribute Id'),
            'sortable'=>true,
            'index'=>'attribute_id',
        ));

        $this->addColumn('attribute_id', array(
            'header'=>Mage::helper('eavmgmt')->__('Attribute Type'),
            'sortable'=>true,
            'index'=>'attribute_id',
            'renderer'=> 'Dharmik_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv_entityType'
        ));


        $this->addColumn('attribute_code', array(
            'header'=>Mage::helper('eavmgmt')->__('Attribute Code'),
            'sortable'=>true,
            'index'=>'attribute_code'
        ));

        $this->addColumn('frontend_label', array(
            'header'=>Mage::helper('eavmgmt')->__('Attribute Label'),
            'sortable'=>true,
            'index'=>'frontend_label'
        ));

        $this->addColumn('frontend_input', array(
            'header'=>Mage::helper('eavmgmt')->__('Input Type'),
            'sortable'=>true,
            'index'=>'frontend_input'
        ));

         $this->addColumn('backend_type', array(
            'header'=>Mage::helper('eavmgmt')->__('backend type'),
            'sortable'=>true,
            'index'=>'backend_type'
        ));

         $this->addColumn('source_model', array(
            'header'=>Mage::helper('eavmgmt')->__('Source Model'),
            'sortable'=>true,
            'index'=>'source_model'
        ));


        return $this;

    }
 
   
}