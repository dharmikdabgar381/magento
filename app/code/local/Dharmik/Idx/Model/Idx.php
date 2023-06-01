<?php

class Dharmik_idx_Model_idx extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('idx/idx');
    }

    public function truncate()
    {
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('import_product_idx');
        return $writeConnection->truncateTable($tableName);
    }

    public function insertOnDuplicate($data, $fields)
    {
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_write');
        $table = $resource->getTableName('import_product_idx');
        return $connection->insertOnDuplicate($table, $data, $fields);
    }

    public function updateBrandTable($data)
    {
        $brandCollection = Mage::getModel('brand/brand')->getCollection();
        $brandNames = $brandCollection->getConnection()
            ->fetchPairs($brandCollection->getSelect()->columns(['brand_id','name']));
        $newBrands = array_diff($data, $brandNames);
        foreach ($newBrands as $name) {
            $prepareData[] = ['name'=>$name];
        }
            if($prepareData){
            $resource = Mage::getSingleton('core/resource');
            $tableName = $resource->getTableName('brand');
            $writeConnection = $resource->getConnection('core_write');
            $writeConnection->insertMultiple($tableName, $prepareData);
        }
        return true;
    }

    public function updateCollectionOption($data)
    {
        $resource = Mage::getSingleton('core/resource');
        $writeAdapter = $resource->getConnection('core_write');
        $optionValueTable = $resource->getTableName('eav_attribute_option_value');
        $collectionNames = $writeAdapter->fetchPairs($writeAdapter->select()->from($optionValueTable, ['option_id','value']));
    
        $newCollections = array_diff($data, $collectionNames);
        foreach ($newCollections as $name) {
            $prepareData[] = ['value'=> [0 => $name]];
        }
        
        if($prepareData){
            $this->addAttributeOption('collection', $prepareData);
        }
        return true;
    }

    public function addAttributeOption($attributeCode, $options)
    {
        $attributeId = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode)->getId();

        foreach ($options as $option) {
            $option['attribute_id'] = $attributeId;

            $optionModel = Mage::getModel('eav/entity_attribute_option');
            $optionModel->setData($option)->save();

            $resource = Mage::getSingleton('core/resource');
            $writeAdapter = $resource->getConnection('core_write');
            $optionValueTable = $resource->getTableName('eav_attribute_option_value');
            foreach ($option['value'] as $storeId => $storeValue) {
                $data = array(
                    'option_id' => $optionModel->getId(),
                    'store_id' => $storeId,
                    'value' => $storeValue,
                );

                $writeAdapter->insert($optionValueTable, $data);
            }
        }
    }


    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;

        return $this;
    }


    public function updateMainProduct($idxProductData)
    {
        $product = Mage::getModel('catalog/product')->getCollection();

        $skuArray = $product->getData();
        $productSkus = array_column($skuArray, 'sku');

        $idxSkuData = array_column($idxProductData, 'sku');

        $newProducts = array_diff($idxSkuData, $productSkus);
        $entityTypeId = Mage::getModel('catalog/product')->getResource()->getTypeId();
        foreach ($idxProductData as $item) {
        $product = Mage::getModel('catalog/product');
            if(in_array($item['sku'], $newProducts))
            {
               $data = [
                'entity_type_id' => $entityTypeId,
                'attribute_set_id' => 4,
                'type_id' => 'simple',
                'sku' => $item['sku'],
                'has_options' => 0,
                'required_options' => 0,
                'name' => $item['name'],
                'price' => $item['price'],
                'status' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED,
                'visibility' => '4',
                'tax_class_id' => '2',
                'weight' => '0.5',
                ];
                $product->setData($data);
                $product->setStockData(array(
                        'is_in_stock' => 1,
                        'qty' => $item['quantity'])
                    );
                $product->save();
            }
        }
    }

    public function checkBrands()
    {
        $resource = Mage::getSingleton('core/resource');
        $writeAdapter = $resource->getConnection('core_write');
        $idxTable = $resource->getTableName('idx/idx');
        $brand = $writeAdapter->fetchRow($writeAdapter->select()->from($idxTable)->where('brand_id = ?',null));
        if($brand)
        {
            return false;    
        }
        return true;
        
    }

    public function checkCollection()
    {
        $resource = Mage::getSingleton('core/resource');
        $writeAdapter = $resource->getConnection('core_write');
        $idxTable = $resource->getTableName('idx/idx');
        $collection = $writeAdapter->fetchRow($writeAdapter->select()->from($idxTable)->where('collection_id = ?',null));
        if($collection)
        {
            return false;    
        }
        return true;   
    }
    

    
}