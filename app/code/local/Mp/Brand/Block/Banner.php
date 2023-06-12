<?php
class Mp_Brand_Block_Banner extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBrands()
    {
        $id = $this->getRequest()->getParam('id');
        return Mage::getModel('brand/brand')->getCollection()->addFieldToFilter('brand_id',$id);
    }
}




