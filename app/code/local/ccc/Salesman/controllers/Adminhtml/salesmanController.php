<?php

/**
 * 
 */
class Ccc_Salesman_Adminhtml_SalesmanController extends Mage_Adminhtml_Controller_Action
{
	
	function indexAction()
	{
        // echo "<pre>";
        // $model = Mage::getModel('salesman/salesman')->load(2);
        // $model->name = "xyz";
        // $model->email = "abc";
        // $model->save();


        // print_r($model->getCollection()->toArray());
        // die;

	  	$this->_title($this->__('Salesman'))
             ->_title($this->__('Manage Salesmen'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_salesman'));
        $this->renderLayout();
	}

    public function newAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('Salesman/items');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
        $this->_addContent($this->getLayout()->createBlock(' salesman/adminhtml_salesman_edit'))->_addLeft($this->getLayout()->createBlock('salesman/adminhtml_salesman_edit_tabs'));
        $this->renderLayout();
    }

    public function editAction() 
    {
        $id = $this->getRequest()->getParam('salesman_id');
        $model = Mage::getModel('salesman/salesman')->load($id);
        $addressModel = Mage::getModel('salesman/salesman_address')->load($id,'salesman_id');

        if ($model->getId() || $id == 0) {
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
        $model->setData($data);
        }

        Mage::register('salesman_data', $model);
        Mage::register('address_data', $addressModel);

        $this->loadLayout();
        $this->_setActiveMenu('salesman/items');

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

        $this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_salesman_edit'))
        ->_addLeft($this->getLayout()
        ->createBlock('salesman/adminhtml_salesman_edit_tabs'));
        $this->renderLayout();
        } else {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Item does not exist'));
        $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('salesman/salesman');
            $data = $this->getRequest()->getPost();
                           
            if (!$salesmanId = $this->getRequest()->getParam('salesman_id'))
            {
                $model->setData($data['salesman'])->setId($this->getRequest()->getParam('salesman_id'));
            }

            $model->setData($data['salesman'])->setId($this->getRequest()->getParam('salesman_id'));

            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }
             
            // $model->save();
            if($model->save())
            {
                if($salesmanId)
                {
                    $addressModel = Mage::getModel('salesman/salesman_address')->load($salesmanId,'salesman_id');
                }
                else
                {
                    $addressModel = Mage::getModel('salesman/salesman_address');
                }
                $addressModel->salesman_id = $model->salesman_id;
                $addressModel->setData(array_merge($addressModel->getData(),$data['salesman_address']));
                $addressModel->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('salesman')->__('Salesman was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('salesman_id' => $model->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('salesman_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Unable to find salesman to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('salesman_id') > 0 ) {
            try {
                $model = Mage::getModel('salesman/salesman');
                 
                $model->setId($this->getRequest()->getParam('salesman_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Salesman was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('salesman_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $salesmanId = $this->getRequest()->getParam('salesman_id');
        if(!is_array($salesmanId)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Please select tax(es).'));
        } else {
            try {
                $model = Mage::getModel('salesman/salesman');
                foreach ($salesmanId as $id) {
                    $model->load($id)->delete();
                }
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('salesman')->__('Total of %d record(s) were deleted.', count($salesmanId))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
         
        $this->_redirect('*/*/index');
    }




}