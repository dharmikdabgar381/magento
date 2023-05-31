<?php

/**
 * 
 */
class Dharmik_Brand_Adminhtml_BrandController extends Mage_Adminhtml_Controller_Action
{
	
	function indexAction()
	{
	  	$this->_title($this->__('Brand'))
             ->_title($this->__('Manage Brands'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('brand/adminhtml_brand'));
        $this->renderLayout();
	}

    public function newAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('Brand/items');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
        $this->_addContent($this->getLayout()->createBlock(' brand/adminhtml_brand_edit'))->_addLeft($this->getLayout()->createBlock('brand/adminhtml_brand_edit_tabs'));
        $this->renderLayout();
    }

    public function editAction() 
    {
        $collection = Mage::getModel('brand/brand')->getCollection()->toArray();
        $id = $this->getRequest()->getParam('brand_id');
        $model = Mage::getModel('brand/brand')->load($id);

        if ($model->getId() || $id == 0) {
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
        $model->setData($data);
        }

        Mage::register('brand_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('brand/items');

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

        $this->_addContent($this->getLayout()->createBlock('brand/adminhtml_brand_edit'))
        ->_addLeft($this->getLayout()
        ->createBlock('brand/adminhtml_brand_edit_tabs'));
        $this->renderLayout();
        } else {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('brand')->__('Item does not exist'));
        $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('brand/brand');
            $data = $this->getRequest()->getPost();
            
            if (!$this->getRequest()->getParam('brand_id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('brand_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('brand_id'));

            if ($model->getCreatedTime() == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }
             
            $model->save();
            if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != '')) 
            {
                try {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png', 'webp'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    
                    $path = Mage::getBaseDir('media') . DS . 'brand' . DS;
                    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    if ($uploader->save($path, $model->getId().'.'.$extension)) {
                        $model->image = $model->getId().".".$extension;
                        $model->save();
                        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('brand')->__('Image was successfully uploaded'));
                    }
                    
                    // $imageName = $uploader->getUploadedFileName();

                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('brand')->__('Brand was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('brand_id' => $model->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('brand_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('brand')->__('Unable to find brand to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('brand_id') > 0 ) {
            try {
                $model = Mage::getModel('brand/brand');
                 
                $model->setId($this->getRequest()->getParam('brand_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Brand was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('brand_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $brandId = $this->getRequest()->getParam('brand_id');
        if(!is_array($brandId)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('brand')->__('Please select tax(es).'));
        } else {
            try {
                $model = Mage::getModel('brand/brand');
                foreach ($brandId as $id) {
                    $model->load($id)->delete();
                }
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('brand')->__('Total of %d record(s) were deleted.', count($brandId))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
         
        $this->_redirect('*/*/index');
    }



}