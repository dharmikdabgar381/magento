<?php

class Ccc_Practice_Adminhtml_QueryController extends Mage_Adminhtml_Controller_Action
{
    public function firstAction()
    {
        // Need a list of product with these columns product name, sku, cost, price, color.
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Ccc_Practice_Block_Adminhtml_First');
        $this->_addContent($block);
        $this->renderLayout();
    }
    public function firstQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $tableName = $resource->getTableName('catalog/product');
        $select = $readConnection->select()
            ->from(array('p' => $tableName), array(
                'sku' => 'p.sku',
                'name' => 'pv.value',
                'cost' => 'pdc.value',
                'price' => 'pdp.value',
                'color' => 'pi.value',
            ))
            ->joinLeft(
                array('pv' => $resource->getTableName('catalog_product_entity_varchar')),
                'pv.entity_id = p.entity_id AND pv.attribute_id = 73',
                array()
            )
            ->joinLeft(
                array('pdc' => $resource->getTableName('catalog_product_entity_decimal')),
                'pdc.entity_id = p.entity_id AND pdc.attribute_id = 81',
                array()
            )
            ->joinLeft(
                array('pdp' => $resource->getTableName('catalog_product_entity_decimal')),
                'pdp.entity_id = p.entity_id AND pdp.attribute_id = 77',
                array()
            )
            ->joinLeft(
                array('pi' => $resource->getTableName('catalog_product_entity_int')),
                'pi.entity_id = p.entity_id AND pi.attribute_id = 94',
                array()
            );

        echo $select;
    }
    public function secondAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Ccc_Practice_Block_Adminhtml_Second');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function secondQueryAction()
    {
    	$attributeOptions = [];

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $attributeOptionTable = $resource->getTableName('eav_attribute_option');
        $attributeTable = $resource->getTableName('eav_attribute');

        $select = $readConnection->select()
            ->from(
                array('ao' => $attributeOptionTable),
                array(
                    'attribute_id' => 'ao.attribute_id',
                    'option_id' => 'ao.option_id',
                    'option_name' => 'ov.value',
                )
            )
            ->joinLeft(
                array('ov' => $resource->getTableName('eav_attribute_option_value')),
                'ov.option_id = ao.option_id',
                array()
            )
            ->join(
                array('a' => $attributeTable),
                'a.attribute_id = ao.attribute_id',
                array('attribute_code' => 'a.attribute_code')
            );

        echo $select;
	}
	public function thirdAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Ccc_Practice_Block_Adminhtml_Third');
        $this->_addContent($block);
        $this->renderLayout();
    }
    public function thirdQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $attributeOptionTable = $resource->getTableName('eav_attribute_option');
        $attributeTable = $resource->getTableName('eav_attribute');

        $select = $readConnection->select()
            ->from(
                array('DD' => $attributeTable),
                array(
                    'attribute_id' => 'DD.attribute_id',
                    'attribute_code' => 'DD.attribute_code',
                )
            )
            ->joinLeft(
                array('option_count_table' => $attributeOptionTable),
                'option_count_table.attribute_id = DD.attribute_id',
                array(
                    'option_count' => 'COUNT(option_count_table.option_id)',
                )
            )
            ->group('DD.attribute_id')
            ->having('COUNT(option_count_table.option_id) > 10', 1);

        echo $select;
    }

    public function fourthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Ccc_Practice_Block_Adminhtml_Fourth');
        $this->_addContent($block);
        $this->renderLayout();
    }
    public function fourthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        echo $select = $readConnection->select()
            ->from(
                array('DD'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('DJ'=>$resource->getTableName('catalog_product_entity_varchar')),
                'DJ.entity_id = DD.entity_id AND DJ.attribute_id = 87',
                array('image' => 'DJ.value')
            )
            ->joinLeft(
                array('thumb'=>$resource->getTableName('catalog_product_entity_varchar')),
                'thumb.entity_id = DD.entity_id AND thumb.attribute_id = 89',
                array('thumbnail' => 'thumb.value')
            )
            ->joinLeft(
                array('small'=>$resource->getTableName('catalog_product_entity_varchar')),
                'small.entity_id = DD.entity_id AND small.attribute_id = 88',
                array('small' => 'small.value')
            );
    }

    public function fifthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Ccc_Practice_Block_Adminhtml_Fifth');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function fifthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('DD'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('m'=>$resource->getTableName('catalog/product_attribute_media_gallery')),
                'm.entity_id = DD.entity_id',
                array('image' => 'COUNT(m.value)')
            )
            ->group('DD.entity_id');
    }
    public function sixthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Ccc_Practice_Block_Adminhtml_Sixth');
        $this->_addContent($block);
        $this->renderLayout();
    }
    public function sixthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('DD'=> $resource->getTableName('customer_entity')),
                array('entity_id','email')
            )
            ->joinLeft(
                array('e'=>$resource->getTableName('customer_entity_varchar')),
                'e.entity_id = DD.entity_id AND e.attribute_id = 5',
                array('firstname' => 'e.value')
            )
            ->joinLeft(
                array('o' => $resource->getTableName('sales/order')),
                'o.customer_id = e.entity_id',
                array('order_count' => 'COUNT(o.entity_id)')
            )
            ->group('DD.entity_id');
    }
    public function sevenAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Ccc_Practice_Block_Adminhtml_Seven');
        $this->_addContent($block);
        $this->renderLayout();
    }
    public function sevenQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('DD'=> $resource->getTableName('customer_entity')),
                array('entity_id','email')
            )
            ->joinLeft(
                array('e'=>$resource->getTableName('customer_entity_varchar')),
                'e.entity_id = DD.entity_id AND e.attribute_id = 5',
                array('firstname' => 'e.value')
            )
            ->joinLeft(
                array('o' => $resource->getTableName('sales/order')),
                'o.customer_id = e.entity_id',
                array('order_count' => 'COUNT(o.entity_id)')
            )
            ->joinLeft(
                array('s' => Mage::getSingleton('core/resource')->getTableName('sales_order_status')),
                'o.status = s.status',
                array('order_status' => 's.label')
            )
            ->group('DD.entity_id');
    }


}

?>