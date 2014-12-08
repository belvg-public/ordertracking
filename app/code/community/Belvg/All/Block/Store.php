<?php

/**
 * BelVG LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 *
 * **************************************
 *         MAGENTO EDITION USAGE NOTICE *
 * ***************************************
 * This package designed for Magento COMMUNITY edition
 * BelVG does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * BelVG does not provide extension support in case of
 * incorrect edition usage.
 * **************************************
 *         DISCLAIMER   *
 * ***************************************
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future.
 * ****************************************************
 * @category    Belvg
 * @package     Belvg_All
 * @copyright   Copyright (c) 2010 - 2014 BelVG LLC. (http://www.belvg.com)
 * @license     http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 */
class Belvg_All_Block_Store extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{

    /**
     * Render extensions store tab
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        return '<div id="' . $element->getId() . '">' . $this->getContent() . '</div>';
    }

    /**
     * Read html from the store feed
     *
     * @return string
     */
    private function getContent()
    {
        $data = NULL;

        if (!extension_loaded('curl')) {
            return $data;
        }

        $url = Mage::helper('belvgall')->getStoreUrl();

        $curl = new Varien_Http_Adapter_Curl();
        $curl->setConfig(array(
                'timeout' => 2,
                'header' => FALSE,
        ));

        $curl->write(Zend_Http_Client::GET, $url, '1.0');
        $data = $curl->read();
        if ($data === FALSE) {
            return NULL;
        }

        $curl->close();

        return $data;
    }

}
