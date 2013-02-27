<?php
/**
 * @package Order Tracking.
 * @author: A.A.Treitjak
 * @copyright: 2012 - 2013 BelVG.com
 */

class Belvg_Ordertracking_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_CONFIG_PATH = 'ordertracking/settings/';

    public function getConfigValue($key, $store = '')
    {
        return Mage::getStoreConfig(self::XML_CONFIG_PATH . $key, $store);
    }

    public function trackingUrl()
    {
        return Mage::getUrl('ordertracking/tracking/index');
    }

    public function showEmail()
    {
        return !$this->_getCustomer()->isLoggedIn();
    }

    public function getCustomerEmail()
    {
        if ($this->_getCustomer()->getCustomerId()) {
            $_customer = Mage::getModel('customer/customer')->load((int) $this->_getCustomer()->getCustomerId());

            return $_customer->getEmail();
        }

        return '';
    }

    public function resultUrl()
    {
        return Mage::getUrl('ordertracking/tracking/tracking');
    }

    protected function _getCustomer()
    {
        return $customer = Mage::getSingleton('customer/session');
    }
}
