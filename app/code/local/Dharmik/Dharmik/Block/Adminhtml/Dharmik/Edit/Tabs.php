<?php 

class Dharmik_Dharmik_Block_Adminhtml_Dharmik_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
        parent::__construct();
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('dharmik')->__('Dharmik Information'));
	}

	public function getDharmik()
    {
        return Mage::registry('current_dharmik');
    }

    protected function _beforeToHtml()
    {
        $dharmik = Mage::registry('current_dharmik');
        $setModel = Mage::getModel('eav/entity_attribute_set');

        if (!($setId = $dharmik->getAttributeSetId())) {
            $setId = $this->getRequest()->getParam('set', null);
        }

        if ($setModel->load($setId)->getAttributeSetId()) {
            
            $dharmikAttributes = Mage::getResourceModel('dharmik/dharmik_attribute_collection');

            if (!$dharmik->getId()) {
                foreach ($dharmikAttributes as $attribute) {
                    $default = $attribute->getDefaultValue();
                    if ($default != '') {
                        $dharmik->setData($attribute->getAttributeCode(), $default);
                    }
                }
            }

            $groupCollection = Mage::getResourceModel('eav/entity_attribute_group_collection')
                ->setAttributeSetFilter($setId)
                ->setSortOrder()
                ->load();

            $defaultGroupId = 0;
            foreach ($groupCollection as $group) {
                if ($defaultGroupId == 0 or $group->getIsDefault()) {
                    $defaultGroupId = $group->getId();
                }

            }	

            foreach ($groupCollection as $group) {
                $attributes = array();
                foreach ($dharmikAttributes as $attribute) {
                    if ($dharmik->checkInGroup($attribute->getId(),$setId, $group->getId())) {
                        $attributes[] = $attribute;
                    }
                }

                if (!$attributes) {
                    continue;
                }

                $active = $defaultGroupId == $group->getId();
                $block = $this->getLayout()->createBlock('dharmik/adminhtml_dharmik_edit_tab_attributes')
                    ->setGroup($group)
                    ->setAttributes($attributes)
                    ->setAddHiddenFields($active)
                    ->toHtml();

                $this->addTab('group_' . $group->getId(), array(
                    'label'     => Mage::helper('dharmik')->__($group->getAttributeGroupName()),
                    'content'   => $block,
                    'active'    => $active
                ));
            }
        } else {
            $this->addTab('set', array(
                'label'     => Mage::helper('dharmik')->__('Settings'),
                'content'   => $this->_translateHtml($this->getLayout()
                    ->createBlock('dharmik/adminhtml_dharmik_edit_tab_setting')->toHtml()),
                'active'    => true
            ));
        }
      return parent::_beforeToHtml();
    }

    protected function _translateHtml($html)
    {
        Mage::getSingleton('core/translate_inline')->processResponseBody($html);
        return $html;
    }
}