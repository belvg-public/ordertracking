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
class Belvg_All_Model_Source_Updates_Type extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    const TYPE_PROMO = 'PROMO';
    const TYPE_NEW_RELEASE = 'NEW_RELEASE';
    const TYPE_UPDATE_RELEASE = 'UPDATE_RELEASE';
    const TYPE_INFO = 'INFO';
    const TYPE_INSTALLED_UPDATE = 'INSTALLED_UPDATE';

    /**
     * Get array of select options
     * 
     * @return array
     */
    public function toOptionArray()
    {
        $helper = Mage::helper('belvgall');
        return array(
                array('value' => self::TYPE_INSTALLED_UPDATE, 'label' => $helper->__('My extensions updates')),
                array('value' => self::TYPE_UPDATE_RELEASE, 'label' => $helper->__('All extensions updates')),
                array('value' => self::TYPE_NEW_RELEASE, 'label' => $helper->__('New Releases')),
                array('value' => self::TYPE_PROMO, 'label' => $helper->__('Promotions/Discounts')),
                array('value' => self::TYPE_INFO, 'label' => $helper->__('Other information'))
        );
    }

    /**
     * Retrive all attribute options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return $this->toOptionArray();
    }

    /**
     * Returns label for value
     * @param string $value
     * @return string
     */
    public function getLabel($value)
    {
        $options = $this->toOptionArray();
        foreach ($options as $v) {
            if ($v['value'] == $value) {
                return $v['label'];
            }
        }

        return '';
    }

    /**
     * Returns array ready for use by grid
     * @return array
     */
    public function getGridOptions()
    {
        $items = $this->getAllOptions();
        $out = array();
        foreach ($items as $item) {
            $out[$item['value']] = $item['label'];
        }

        return $out;
    }

}
