<?php

class Dharmik_Idx_Block_Adminhtml_Idx_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form(array(
		'id' => 'edit_form',
		'action' => $this->getUrl('*/*/importCsv', array('index' => $this->getRequest()->getParam('index'))),
		'method' => 'post',
		'enctype' => 'multipart/form-data'
		));
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}