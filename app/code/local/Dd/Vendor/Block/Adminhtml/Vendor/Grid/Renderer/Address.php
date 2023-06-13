<?php
class Dd_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_Address extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $address = $row->getData($this->getColumn()->getIndex());
        $formattedAddress = $address . '<br/>' . $row->getData('postal_code') . ', ' . $row->getData('city') . ', ' . $row->getData('state');
        return $formattedAddress;
    }
}
