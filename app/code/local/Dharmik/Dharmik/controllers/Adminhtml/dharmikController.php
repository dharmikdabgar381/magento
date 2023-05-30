<?php 

class Dharmik_Dharmik_Adminhtml_DharmikController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction(){
        $this->loadLayout();
        $this->_setActiveMenu('dharmik');
        $this->_title('Dharmik Grid');
        $this->_addContent($this->getLayout()->createBlock('dharmik/adminhtml_dharmik'));
        $this->renderLayout();
    }

    protected function _initDharmik()
    {
        $this->_title($this->__('Dharmik'))
            ->_title($this->__('Manage Dharmiks'));

        $dharmikId = (int) $this->getRequest()->getParam('id');
        $dharmik   = Mage::getModel('dharmik/dharmik')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($dharmikId);

        if (!$dharmikId) {
            if ($setId = (int) $this->getRequest()->getParam('set')) {
                $dharmik->setAttributeSetId($setId);
            }
        }

        Mage::register('current_dharmik', $dharmik);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $dharmik;
    }

    public function newAction(){
        $this->_forward('edit');
    }

    public function editAction(){ 
        $dharmikId = (int) $this->getRequest()->getParam('id');
        $dharmik   = $this->_initDharmik();
        
        if ($dharmikId && !$dharmik->getId()) {
            $this->_getSession()->addError(Mage::helper('dharmik')->__('This dharmik no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($dharmik->getName());

        $this->loadLayout();

        $this->_setActiveMenu('dharmik/dharmik');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $setId = (int) $this->getRequest()->getParam('set');
            $dharmikData = $this->getRequest()->getPost('account');            
            $dharmik = Mage::getSingleton('dharmik/dharmik');
            $dharmik->setAttributeSetId($setId);

            if ($dharmikId = $this->getRequest()->getParam('id')) {
                if (!$dharmik->load($dharmikId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
            }
            
            $dharmik->addData($dharmikData);

            $dharmik->save();

            Mage::getSingleton('core/session')->addSuccess("dharmik data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {

            $dharmikModel = Mage::getModel('dharmik/dharmik');

            if (!($dharmikId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$dharmikModel->load($dharmikId)) {
                throw new Exception('dharmik does not exist');
            }

            if (!$dharmikModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The dharmik has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }
}