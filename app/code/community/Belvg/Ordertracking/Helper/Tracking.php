<?php
/**
 * @package Order Tracking.
 * @author: A.A.Treitjak
 * @copyright: 2012 - 2013 BelVG.com
 */
class Belvg_Ordertracking_Helper_Tracking extends Mage_Shipping_Helper_Data
{
    public function getTrackingServices($email, $orderID)
    {
        $_order = Mage::getModel('sales/order')->loadByIncrementId($orderID);
        ;

        if (!$_order) {
            return array();
        }

        if (Mage::helper('ordertracking')->showEmail()) {
            if ($_order->getCustomerEmail() != $email) {
                return array();
            }
        } else {
            if ($_order->getCustomerEmail() != Mage::helper('ordertracking')->getCustomerEmail()) {
                return array();
            }
        }

        if ($_order->getStatus() != 'complete') {
            return array();
        }

        $return = array();

        if ($_order->hasShipments()) {
            foreach ($_order->getTracksCollection() as $_shipping) {
                if ($_shipping['carrier_code'] == 'custom' || $_shipping['carrier_code'] == '') {
                    return array();
                }

                $_item = new Varien_Object();

                $_item->setCode($_shipping->getCarrierCode());
                $_item->setTitle($_shipping->getTitle());
                $_item->setTrackNumber($_shipping->getTrackNumber());
                $_item->setUrl($this->getTrackingPopupUrlBySalesModel($_shipping));

                $return[] = $_item;
            }
        }

        return $return;
    }
}
