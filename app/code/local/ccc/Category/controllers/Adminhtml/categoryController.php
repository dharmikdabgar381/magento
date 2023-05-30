<?php

/**
 * 
 */
class Ccc_Category_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
{
	
	function indexAction()
	{
        // echo "<pre>";
        // $model = Mage::getModel('category/category')->load(2);
        // $model->name = "xyz";
        // $model->email = "abc";
        // $model->save();


        // print_r($model->getCollection()->toArray());
        // die;

	  	$this->_title($this->__('Category'))
             ->_title($this->__('Manage Categories'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('category/adminhtml_category'));
        $this->renderLayout();
	}

    public function newAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('Category/items');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
        $this->_addContent($this->getLayout()->createBlock(' category/adminhtml_category_edit'))->_addLeft($this->getLayout()->createBlock('category/adminhtml_category_edit_tabs'));
        $this->renderLayout();
    }

    public function editAction() 
    {
        $id = $this->getRequest()->getParam('category_id');
        $model = Mage::getModel('category/category')->load($id);

        if ($model->getId() || $id == 0) {
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
        $model->setData($data);
        }

        Mage::register('category_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('category/items');

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

        $this->_addContent($this->getLayout()->createBlock('category/adminhtml_category_edit'))
        ->_addLeft($this->getLayout()
        ->createBlock('category/adminhtml_category_edit_tabs'));
        $this->renderLayout();
        } else {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category')->__('Item does not exist'));
        $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('category/category');
            $data = $this->getRequest()->getPost();
            
            if (!$this->getRequest()->getParam('category_id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('category_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('category_id'));

            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }
             
            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('category')->__('Category was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('category_id' => $model->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('category_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category')->__('Unable to find category to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('category_id') > 0 ) {
            try {
                $model = Mage::getModel('category/category');
                 
                $model->setId($this->getRequest()->getParam('category_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('category was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('category_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $categoryId = $this->getRequest()->getParam('category_id');
        if(!is_array($categoryId)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category')->__('Please select tax(es).'));
        } else {
            try {
                $model = Mage::getModel('category/category');
                foreach ($categoryId as $id) {
                    $model->load($id)->delete();
                }
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('category')->__('Total of %d record(s) were deleted.', count($categoryId))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
         
        $this->_redirect('*/*/index');
    }



}