<?php
class Ccc_Practice_Adminhtml_SixteenController extends Mage_Core_Controller_Front_Action
{
       public function indexAction()
       {

        $model = Mage::getModel('practice/practice');
        Mage::dispatchEvent('cms_page_prepare_save', array('page' => $model, 'request' => $this->getRequest()));
       }
}
