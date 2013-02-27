<?php
/**
 * @package Order Tracking.
 * @author: A.A.Treitjak
 * @copyright: 2012 - 2013 BelVG.com
 */

class Belvg_Ordertracking_TrackingController extends Mage_Core_Controller_Front_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
        if (!Mage::helper('ordertracking')->getConfigValue('enabled')) {
            $this->_forward('defaultNoRoute');
        }
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function trackingAction()
    {
        $this->loadLayout();

        if ($this->getRequest()->isPost()) {
            $email = (string) $this->getRequest()->getParam('email', '');
            $order = (int) $this->getRequest()->getParam('order', '0');

            $services = Mage::helper('ordertracking/tracking')->getTrackingServices($email, $order);

            if ($services) {
                Mage::register('tracking_order', $services);

                $this->getLayout()
                    ->getBlock('order.tracking.result')
                    ->setTemplate('belvg/ordertracking/result.phtml');
            } else {
                $this->getLayout()
                    ->getBlock('order.tracking.result')
                    ->setTemplate('belvg/ordertracking/notfound.phtml');
            }
        }

        $this->renderLayout();
    }
}
