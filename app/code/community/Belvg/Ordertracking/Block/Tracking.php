<?php
/**
 * @package Order Tracking.
 * @author: A.A.Treitjak
 * @copyright: 2012 - 2013 BelVG.com
 */

class Belvg_Ordertracking_Block_Tracking extends Mage_Core_Block_Template
{
    public function getFormUrl()
    {
        return $this->helper('ordertracking')->resultUrl();
    }

    public function getNotFoundMessage()
    {
        return $this->helper('ordertracking')->getConfigValue('tracking_nofound');
    }

    public function getTrackingServices()
    {
        if (Mage::registry('tracking_order')) {
            return Mage::registry('tracking_order');
        }

        return array();
    }
}
