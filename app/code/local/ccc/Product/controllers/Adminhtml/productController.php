<?php

/**
 * 
 */
class Ccc_Product_Adminhtml_ProductController extends Mage_Adminhtml_Controller_Action
{
	
	function indexAction()
	{
        // echo "<pre>";
        // $model = Mage::getModel('product/product')->load(2);
        // $model->name = "xyz";
        // $model->email = "abc";
        // $model->save();


        // print_r($model->getCollection()->toArray());
        // die;

	  	$this->_title($this->__('Product'))
             ->_title($this->__('Manage Products'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('product/adminhtml_product'));
        $this->renderLayout();
	}

    public function newAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('Product/items');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
        $this->_addContent($this->getLayout()->createBlock('product/adminhtml_product_edit'))->_addLeft($this->getLayout()->createBlock('product/adminhtml_product_edit_tabs'));
        $this->renderLayout();
    }

    public function editAction() 
    {
        // echo "<pre>";
        // $collection = Mage::getModel('product/product')->getCollection()->toArray();
        // print_r($collection);




        // die;
        $id = $this->getRequest()->getParam('product_id');
        $model = Mage::getModel('product/product')->load($id);

        if ($model->getId() || $id == 0) {
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
        $model->setData($data);
        }

        Mage::register('product_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('product/items');

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

        $this->_addContent($this->getLayout()->createBlock('product/adminhtml_product_edit'))
        ->_addLeft($this->getLayout()
        ->createBlock('product/adminhtml_product_edit_tabs'));
        $this->renderLayout();
        } else {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product')->__('Item does not exist'));
        $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('product/product');
            $data = $this->getRequest()->getPost();
            
            if (!$this->getRequest()->getParam('product_id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('product_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('product_id'));

            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }
             
            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product')->__('Product was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('product_id' => $model->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('product_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product')->__('Unable to find product to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('product_id') > 0 ) {
            try {
                $model = Mage::getModel('product/product');
                 
                $model->setId($this->getRequest()->getParam('product_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Product was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('product_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $productId = $this->getRequest()->getParam('product_id');
        if(!is_array($productId)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product')->__('Please select tax(es).'));
        } else {
            try {
                $model = Mage::getModel('product/product');
                foreach ($productId as $id) {
                    $model->load($id)->delete();
                }
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('product')->__('Total of %d record(s) were deleted.', count($productId))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
         
        $this->_redirect('*/*/index');
    }



}