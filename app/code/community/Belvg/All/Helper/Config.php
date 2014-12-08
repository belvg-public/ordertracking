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
class Belvg_All_Helper_Config extends Mage_Core_Helper_Data
{

    const XML_PATH_FREQUENCY = 'belvgall/feed/check_frequency';
    const XML_PATH_LAST_UPDATE = 'belvgall/feed/last_update';
    const XML_PATH_INTERESTS = 'belvgall/feed/interests';
    const XML_PATH_INSTALLED = 'belvgall/feed/installed';
    const URL_NEWS = 'http://belvg.com/feed-news.xml';
    const URL_STORE = 'http://belvg.com/promoadmin/fbfree.xml';

    /**
     * Return URL to the feed
     *
     * @return string
     */
    public function getFeedUrl()
    {
        return self::URL_NEWS;
    }

    /**
     * Get URL for the etension store tab
     *
     * @return string
     */
    public function getStoreUrl()
    {
        return self::URL_STORE;
    }

    /**
     * Get user selected interests
     *
     * @return string
     */
    public function getInterests()
    {
        return Mage::getStoreConfig(self::XML_PATH_INTERESTS);
    }

    /**
     * Date of the Belvg_ALL module installation (timestamp)
     * @return int
     */
    public function getInstalledDate()
    {
        return Mage::getStoreConfig(self::XML_PATH_INSTALLED);
    }

    /**
     * Save data to the configuration and cache
     * 
     * @param string $key
     * @param string $data
     * @param string $scope
     * @param int $store
     * @return Belvg_All_Helper_Config
     */
    public function saveConfig($key, $data, $scope = 'default', $store = 0)
    {
        Mage::app()->saveCache($data, $key);
        Mage::getModel('core/config')->saveConfig($key, $data, $scope, $store);
        return $this;
    }

}
