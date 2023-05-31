<?php
class Dharmik_Idx_Adminhtml_IdxController extends Mage_Adminhtml_Controller_Action
{
    
    function indexAction()
    {
        $this->_title($this->__('Idx'))
             ->_title($this->__('Manage Idxs'));
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
        $id = $this->getRequest()->getParam('idx_id');
        $model = Mage::getModel('idx/idx')->load($id);
        $addressModel = Mage::getModel('idx/idx_address')->load($id,'idx_id');

        if ($model->getId() || $id == 0) {
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
        $model->setData($data);
        }

        Mage::register('idx_data', $model);
        Mage::register('address_data', $addressModel);

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

    public function saveAction()
    {
        try {
            $model = Mage::getModel('idx/idx');
            $data = $this->getRequest()->getPost();
            
            if (!$idxId = $this->getRequest()->getParam('idx_id'))
            {
                $model->setData($data['idx'])->setId($this->getRequest()->getParam('idx_id'));
            }

            $model->setData($data['idx'])->setId($this->getRequest()->getParam('idx_id'));

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
                if($idxId)
                {
                    $addressModel = Mage::getModel('idx/idx_address')->load($idxId,'idx_id');
                }
                else
                {
                    $addressModel = Mage::getModel('idx/idx_address');
                }
                $addressModel->idx_id = $model->idx_id;
                $addressModel->setData(array_merge($addressModel->getData(),$data['idx_address']));
                $addressModel->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('idx')->__('Idx was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('idx_id' => $model->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('idx_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('idx')->__('Unable to find idx to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('idx_id') > 0 ) {
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
        $idxId = $this->getRequest()->getParam('idx_id');
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




}