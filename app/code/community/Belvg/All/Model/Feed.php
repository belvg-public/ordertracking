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
class Belvg_All_Model_Feed extends Mage_AdminNotification_Model_Feed
{

    /**
     * @var Belvg_All_Helper_Data
     */
    private $_helper;

    /**
     * Init model, create helper instance
     *
     * @return void
     */
    public function _construct()
    {
        $this->_helper = Mage::helper('belvgall');
        parent::_construct();
    }

    /**
     * Check feed for modification
     *
     * @return Belvg_All_Model_Feed
     */
    public function checkUpdate()
    {
        $now = Zend_Date::now()->getTimestamp();

        if (($this->_helper->getFrequency() + $this->_helper->getLastUpdate()) > $now) {
            return $this;
        }

        $this->_helper->setLastUpdate($now);

        if (!extension_loaded('curl')) {
            return $this;
        }

        $feed_data = array();
        $feed_xml = $this->getFeedData();
        $was_installed = gmdate('Y-m-d H:i:s', $this->_helper->getInstalledDate());

        if ($feed_xml && $feed_xml->channel && $feed_xml->channel->item) {
            foreach ($feed_xml->channel->item as $item) {
                $date = $this->getDate((string) $item->pubDate);

                if ($date < $was_installed) {
                    continue;
                }

                if (!$this->isInteresting($item)) {
                    continue;
                }

                $feed_data[] = array(
                        'severity' => 3,
                        'date_added' => $this->getDate($date),
                        'title' => (string) $item->title,
                        'description' => (string) $item->description,
                        'url' => (string) $item->link,
                );
            }

            if ($feed_data) {
                Mage::getModel('adminnotification/inbox')->parse($feed_data);
            }
        }
    }

    /**
     * Get feed xml URL
     * @return string
     */
    public function getFeedUrl()
    {
        $feedUrl = $this->_helper->getFeedUrl();
        $base_url = Mage::getStoreConfig('web/unsecure/base_url');
        $query = '?s=' . urlencode($base_url);

        return $feedUrl . $query;
    }

    /**
     * Process user's selections for feed filters
     * 
     * @param SimpleXMLElement $item
     * @return boolean
     */
    protected function isInteresting($item)
    {
        $interests = @explode(',', $this->_helper->getInterests());
        $types = @explode(':', (string) $item->type);

        $extenion = (string) $item->extension;

        foreach ($types as $type) {
            if (in_array($type, $interests)) {
                return TRUE;
            }

            if ($extenion && ($type == Belvg_All_Model_Source_Updates_Type::TYPE_UPDATE_RELEASE)) {
                if ($this->_helper->hasExtension($extenion)) {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

}
