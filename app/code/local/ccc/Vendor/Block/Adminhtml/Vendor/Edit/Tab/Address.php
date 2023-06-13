<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$vendorField = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor Address information')));


		$vendorField->addField('address', 'text', array(
            'label' => Mage::helper('vendor')->__('Address'),
            'required' => true,
            'name' => 'vendor_address[address]',
		));

		$vendorField->addField('postal_code', 'text', array(
            'label' => Mage::helper('vendor')->__('Postal Code'),
            'required' => true,
            'name' => 'vendor_address[postal_code]',
		));

		$vendorField->addField('country', 'select', array(
            'label' => Mage::helper('vendor')->__('Country'),
            'required' => true,
            'name' => 'vendor_address[country]',
            'values'    => Mage::getModel('directory/country')->getResourceCollection()
                            ->loadByStore()
                            ->toOptionArray(),
            'onchange'  => 'updateStateOptions(this.value)'
		));

		$vendorField->addField('state', 'select', array(
            'label' => Mage::helper('vendor')->__('State'),
            'required' => true,
            'name' => 'vendor_address[state]',
            'values'    => Mage::getModel('directory/region')->getResourceCollection()
                            ->addCountryFilter($countryId)
                            ->load()
                            ->toOptionArray()
		));

		$script = '
            <script>
            function updateStateOptions(countryId) {
                console.log(countryId);
                var url = "' . $this->getUrl('*/*/updateStateOptions') . '"; // Replace with your controller action URL
                new Ajax.Request(url, {
                    method: "post",
                    parameters: { country_id: countryId },
                    onSuccess: function(transport) {
                        var response = transport.responseText.evalJSON();
                        var stateField = $("state");
                        stateField.update("");
                        response.each(function(option) {
                            stateField.insert(new Element("option", { value: option.value }).update(option.label));
                        });
                    }
                });
            }
            </script>';
            
        $vendorField->addField('ajax_script', 'note', array(
            'text'     => $script,
            'after_element_html' => '',
        ));

		$vendorField->addField('city', 'text', array(
            'label' => Mage::helper('vendor')->__('City'),
            'required' => true,
            'name' => 'vendor_address[city]',
		));

		if ( Mage::getSingleton('adminhtml/session')->getsalesmanData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getsalesmanData());
			Mage::getSingleton('adminhtml/session')->setsalesmanData(null);
		} 
		elseif ( Mage::registry('address_data') ) 
		{
			$form->setValues(Mage::registry('address_data')->getData());
		}
		return parent::_prepareForm();
	}
}
