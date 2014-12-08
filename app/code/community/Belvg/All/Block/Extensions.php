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
class Belvg_All_Block_Extensions extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{

    /**
     * @var Mage_Adminhtml_Block_System_Config_Form_Field
     */
    protected $_fieldRenderer;

    /**
     * Render installed belvg modules
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $html = $this->_getHeaderHtml($element);
        $modules = array_keys((array) Mage::getConfig()->getNode('modules')->children());

        sort($modules);

        foreach ($modules as $moduleName) {
            if (strstr($moduleName, 'Belvg_') === FALSE) {
                continue;
            }

            if ($moduleName == 'Belvg_All') {
                continue;
            }

            $html .= $this->_getFieldHtml($element, $moduleName);
        }

        $html .= $this->_getFooterHtml($element);

        return $html;
    }

    /**
     * Get renderer class
     *
     * @return Mage_Adminhtml_Block_System_Config_Form_Field
     */
    protected function _getFieldRenderer()
    {
        if (empty($this->_fieldRenderer)) {
            $this->_fieldRenderer = Mage::getBlockSingleton('adminhtml/system_config_form_field');
        }

        return $this->_fieldRenderer;
    }

    /**
     * Fromat list of BelVG extensions
     *
     * @param type $fieldset
     * @param string $moduleCode
     * @return string
     */
    protected function _getFieldHtml($fieldset, $moduleCode)
    {
        $currentVer = Mage::getConfig()->getModuleConfig($moduleCode)->version;
        if (!$currentVer) {
            return '';
        }

        $moduleName = substr($moduleCode, strpos($moduleCode, '_') + 1);
        $module = __('<img src="%s" title="%s"></a> %s', $this->getSkinUrl('images/success_msg_icon.gif'), $this->__('installed'), $moduleName);

        $field = $fieldset->addField($moduleCode, 'label', array(
                        'name' => 'dummy',
                        'label' => $module,
                        'value' => $currentVer,
                ))->setRenderer($this->_getFieldRenderer());

        return $field->toHtml();
    }

}
