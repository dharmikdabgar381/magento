<?php
class Dd_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_State extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $countryId = $row->getData('country');
        $stateId = $row->getData($this->getColumn()->getIndex());

        $html = '';
        if ($countryId && $stateId) {
            $stateOptions = Mage::getModel('directory/region')->getResourceCollection()
                ->addCountryFilter($countryId)
                ->toOptionArray();

            foreach ($stateOptions as $stateOption) {
                if ($stateOption['value'] == $stateId) {
                    $html = $stateOption['label'];
                    break;
                }
            }
        }

        return $html;
    }
}
