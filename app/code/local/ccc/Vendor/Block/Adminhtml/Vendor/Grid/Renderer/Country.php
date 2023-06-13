<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_Country extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $countryId = $row->getData($this->getColumn()->getIndex());
        $countryName = Mage::getModel('directory/country')->load($countryId)->getName();
        return $countryName;
    }
}
