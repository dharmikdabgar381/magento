<?php

/**
 * 
 */
class Dharmik_Idx_Adminhtml_IdxController extends Mage_Adminhtml_Controller_Action
{
    
    function indexAction()
    {
        $this->_title($this->__('Idx'))
             ->_title($this->__('Manage Idx'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('idx/adminhtml_idx'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('Idx/items');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
        $this->_addContent($this->getLayout()->createBlock(' idx/adminhtml_idx_edit'))->_addLeft($this->getLayout()->createBlock('idx/adminhtml_idx_edit_tabs'));
        $this->renderLayout();
    }

    public function editAction() 
    {
        $collection = Mage::getModel('idx/idx')->getCollection()->toArray();
        $id = $this->getRequest()->getParam('idx_id');
        $model = Mage::getModel('idx/idx')->load($id);

        if ($model->getId() || $id == 0) {
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
        $model->setData($data);
        }

        Mage::register('idx_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('idx/items');

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

        $this->_addContent($this->getLayout()->createBlock('idx/adminhtml_idx_edit'))
        ->_addLeft($this->getLayout()
        ->createBlock('idx/adminhtml_idx_edit_tabs'));
        $this->renderLayout();
        } else {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('idx')->__('Item does not exist'));
        $this->_redirect('*/*/');
        }
    }

   
    public function importCsvAction()
    {
        try { 
            Mage::getModel('idx/idx')->truncate();
            $csvFile = $_FILES['import_options']['tmp_name'];
            $csvData = file_get_contents($csvFile);
            $csvData = array();
            // echo "<pre>";
            // print_r($csvData);
            // die;


            if (($handle = fopen($csvFile, 'r')) !== false) {
                while (($data = fgetcsv($handle)) !== false) {
                    $row = array();
                    foreach ($data as $value) {
                        $row[] = $value;
                    }
                    $csvData[] = $row;
                }
                  fclose($handle);
            }

            $header = [];
            $idxModel = Mage::getModel('idx/idx');
            foreach ($csvData as $value)
            {
                if(!$header)
                {
                    $header = $value;
                }
                else
                {
                    $data = array_combine($header,$value);
                    $idxModel->insertOnDuplicate($data, array_keys($data));
                }
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('idx')->__('Data Imported successfully.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/adminhtml_idx/index'); 
    }


    // public function brandAction()
    // {
    //     try {
    //         $idx = Mage::getModel('idx/idx');       
    //         $idxCollection = $idx->getCollection();
    //         $idxCollectionArray = $idx->getCollection()->getData();

    //         $idxBrandId = array_column($idxCollectionArray,'index');
    //         $idxBrandNames = array_column($idxCollectionArray,'brand');
    //         $idxBrandNames = array_combine($idxBrandId,$idxBrandNames);
            
    //         $newBrands = $idx->updateBrandTable(array_unique($idxBrandNames));
    //         $idxCollection = $idx->getCollection();
    //         foreach ($idxCollection as $idx) {
    //             if(!$idx->brand_id)
    //             {
    //                 $brand = Mage::getModel('brand/brand');
    //                 $brandCollection = Mage::getModel('brand/brand')->getCollection();
    //                 $brandCollection->getSelect()->where('main_table.name=?',$idx->brand);
    //                 $brandData = $brandCollection->getData();
    //                 $resource = Mage::getSingleton('core/resource');
    //                 $connection = $resource->getConnection('core_write');
    //                 $tableName = $resource->getTableName('import_product_idx');
    //                 $condition = '`index` = '.$idx->index;
    //                 $query = "UPDATE `{$tableName}` SET `brand_id` = {$brandData[0]['brand_id']} WHERE {$condition}";
    //                 $connection->query($query); 
    //             }
    //         }
    //         Mage::getSingleton('adminhtml/session')->addSuccess('Brand is fine now');
    //     } catch (Exception $e) {
    //         Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    //     }
    //     $this->_redirect('*/*/index');
    // }
    

    //         }

    //         Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('idx')->__('Data Imported successfully.'));
    //     } catch (Exception $e) {
    //         Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    //     }
    //     $this->_redirect('*/adminhtml_idx/index'); 
    // }


    public function brandAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');       
            $idxCollection = $idx->getCollection();
            $idxCollectionArray = $idx->getCollection()->getData();

            $idxBrandId = array_column($idxCollectionArray,'index');
            $idxBrandNames = array_column($idxCollectionArray,'brand');
            $idxBrandNames = array_combine($idxBrandId,$idxBrandNames);
            
            $newBrands = $idx->updateBrandTable(array_unique($idxBrandNames));
            $idxCollection = $idx->getCollection();
            foreach ($idxCollection as $idx) {
                if(!$idx->brand_id)
                {
                    $brand = Mage::getModel('brand/brand');
                    $brandCollection = Mage::getModel('brand/brand')->getCollection();
                    $brandCollection->getSelect()->where('main_table.name=?',$idx->brand);
                    $brandData = $brandCollection->getData();
                    $resource = Mage::getSingleton('core/resource');
                    $connection = $resource->getConnection('core_write');
                    $tableName = $resource->getTableName('import_product_idx');
                    $condition = '`index` = '.$idx->index;
                    $query = "UPDATE `{$tableName}` SET `brand_id` = {$brandData[0]['brand_id']} WHERE {$condition}";
                    $connection->query($query); 
                }
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Brand is fine now');
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }

    public function collectionAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');  
            $idxCollection = $idx->getCollection();     
            $idxCollectionData = $idx->getCollection()->getData();

            $idxCollectionNames = array_column($idxCollectionData,'collection');
            $newCollections = $idx->updateCollectionOption(array_unique($idxCollectionNames));
            $resource = Mage::getSingleton('core/resource');
            $writeAdapter = $resource->getConnection('core_write');

            $idxTable = $resource->getTableName('idx/idx');
            $optionValueTable = $resource->getTableName('eav_attribute_option_value');
            $updateQuery = "
                UPDATE {$idxTable} p
                JOIN (
                    SELECT option_id,value
                    FROM {$optionValueTable}
                ) o ON p.`collection` = o.`value`
                SET p.`collection_id` = o.`option_id`
            ";

            $writeAdapter->query($updateQuery);
    
            Mage::getSingleton('adminhtml/session')->addSuccess('Collection is fine now');
        } catch (Exception $e) {
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }


    public function deleteAction()
    {
        if( $this->getRequest()->getParam('index') > 0 ) {
            try {
                $model = Mage::getModel('idx/idx');
                 
                $model->setId($this->getRequest()->getParam('idx_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Idx was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('idx_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $idxId = $this->getRequest()->getParam('index');
        if(!is_array($idxId)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('idx')->__('Please select tax(es).'));
        } else {
            try {
                $model = Mage::getModel('idx/idx');
                foreach ($idxId as $id) {
                    $model->load($id)->delete();
                }
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('idx')->__('Total of %d record(s) were deleted.', count($idxId))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
         
        $this->_redirect('*/*/index');
    }


    public function productAction()
    {
        try {
            $idxModel = Mage::getModel('idx/idx');
            $brandResult = $idxModel->checkBrands();
            $collectionResult = $idxModel->checkCollection();

            if (!$brandResult && !$collectionResult) {
                Mage::getSingleton('adminhtml/session')->addError('Brand is not fine');
                Mage::getSingleton('adminhtml/session')->addError('Collection is not fine');
            } 
            elseif (!$brandResult) {
                Mage::getSingleton('adminhtml/session')->addError('Brand is not fine');
            }
            elseif (!$collectionResult) {
                Mage::getSingleton('adminhtml/session')->addError('Collection is not fine');
            }
            else {
            $idx = Mage::getModel('idx/idx');       
            $idxCollection = $idx->getCollection();
            $idxCollectionArray = $idx->getCollection()->getData();

            $newProducts = $idx->updateMainProduct($idxCollectionArray);

            $write = Mage::getSingleton('core/resource')->getConnection('core_write');
            $sourceTable = Mage::getSingleton('core/resource')->getTableName('catalog_product_entity');
            $destinationTable = Mage::getSingleton('core/resource')->getTableName('import_product_idx');

            $query = "UPDATE {$destinationTable} AS dest
                      INNER JOIN {$sourceTable} AS src ON dest.sku = src.sku
                      SET dest.product_id = src.entity_id";
            $write->query($query);
            
            Mage::getSingleton('adminhtml/session')->addSuccess('Products imported successfully');
            }

            // if (!$collectionResult) {
            // }



        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::logException($e);
        }
        $this->_redirect('*/*/index');
    }


}
