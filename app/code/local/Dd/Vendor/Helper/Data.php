<?php
/**
 * 
 */
class Dd_Vendor_Helper_Data extends Mage_Core_Helper_Abstract
{
	const REFERER_QUERY_PARAM_NAME = 'referer';
    const ROUTE_ACCOUNT_LOGIN = 'customer/account/login';
    
	function __construct()
	{
		// code...
	}
	public function getLoginPostUrl()
    {
        $params = array();
        if ($this->_getRequest()->getParam(self::REFERER_QUERY_PARAM_NAME)) {
            $params = array(
                self::REFERER_QUERY_PARAM_NAME => $this->_getRequest()->getParam(self::REFERER_QUERY_PARAM_NAME)
            );
        }
        return $this->_getUrl('vendor/account/login', $params);
    }
    public function getRegisterUrl()
    {
        return $this->_getUrl('vendor/account/create');
    }
    public function getForgotPasswordUrl()
    {
        return $this->_getUrl('vendor/account/forgotpassword');
    }

    public function getRegisterPostUrl()
    {
        return $this->_getUrl('vendor/account/createpost');
    }
    public function getLoginUrl()
    {
        return $this->_getUrl('vendor/account/login', $params);
    }
}