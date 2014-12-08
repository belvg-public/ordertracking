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
$this->startSetup();

$helper = Mage::helper('belvgall')
        ->saveConfig(Belvg_All_Helper_Config::XML_PATH_INSTALLED, time())
        ->saveConfig(Belvg_All_Helper_Config::XML_PATH_FREQUENCY, 3600*6)
        ->saveConfig(Belvg_All_Helper_Config::XML_PATH_LAST_UPDATE, 0)
        ->saveConfig(Belvg_All_Helper_Config::XML_PATH_INTERESTS, 'INSTALLED_UPDATE,UPDATE_RELEASE,NEW_RELEASE,PROMO,INFO');


$feedData = array();
$feedData[] = array(
    'severity'      => 4,
    'date_added'    => gmdate('Y-m-d H:i:s', time()),
    'title'         => "Belvg's extension has been installed. Check the Admin > Configuration > Belvg Extensions.",
    'description'   => 'You can see versions of the installed extensions right in the admin, as well as configure notifications about major updates.',
    'url'           => 'http://store.belvg.com/blog/'
);
Mage::getModel('adminnotification/inbox')->parse($feedData);

$this->endSetup();