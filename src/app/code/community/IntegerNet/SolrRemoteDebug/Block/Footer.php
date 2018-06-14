<?php
/**
 * integer_net Magento Module
 *
 * @copyright  Copyright (c) 2017 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */
class IntegerNet_SolrRemoteDebug_Block_Footer extends Mage_Core_Block_Template
{
    public function getResponses()
    {
        $responses = Mage::registry('integernet_solr_data');
        if (!$responses) {
            return [];
        }
        return $responses;
    }

    protected function _toHtml()
    {
        if (!Mage::app()->getRequest()->getParam('solrdebug')) {
            return '';
        }
        return parent::_toHtml();
    }
}