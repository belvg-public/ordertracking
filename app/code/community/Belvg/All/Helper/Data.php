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
class Belvg_All_Helper_Data extends Belvg_All_Helper_Config
{

    /**
     * Get update feed frequency
     *
     * @return int
     */
    public function getFrequency()
    {
        $frequency = Mage::app()->loadCache(self::XML_PATH_FREQUENCY);

        if (!$frequency) {
            $frequency = Mage::getStoreConfig(self::XML_PATH_FREQUENCY);
            $this->saveConfig(self::XML_PATH_FREQUENCY, $frequency);
        }

        return $frequency;
    }

    /**
     * Get timestamp of the date when last feed update was performed
     *
     * @return int
     */
    public function getLastUpdate()
    {
        $last_check = Mage::app()->loadCache(self::XML_PATH_LAST_UPDATE);
        if (!$last_check) {
            $last_check = Mage::getStoreConfig(self::XML_PATH_LAST_UPDATE);
            $this->saveConfig(self::XML_PATH_LAST_UPDATE, $last_check);
        }

        return $last_check;
    }

    /**
     * Save date of the last feed update (timestamp)
     *
     * @param Belvg_All_Helper_Data
     */
    public function setLastUpdate($datetime = NULL)
    {
        if (is_null($datetime)) {
            $datetime = Zend_Date::now()->getTimestamp();
        }

        $this->saveConfig(self::XML_PATH_LAST_UPDATE, $datetime);
        return $this;
    }

    /**
     * Check if extension is installed
     *
     * @param string $code
     * @return boolean
     */
    public function hasExtension($code)
    {
        $modules = array_keys((array) Mage::getConfig()->getNode('modules')->children());

        if (in_array($code, $modules)) {
            return TRUE;
        }

        return FALSE;
    }

}
