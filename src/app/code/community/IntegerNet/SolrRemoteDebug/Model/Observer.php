<?php
/**
 * integer_net Magento Module
 *
 * @copyright  Copyright (c) 2018 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */
class IntegerNet_SolrRemoteDebug_Model_Observer
{

    public function integernetSolrBeforeSearchRequest(Varien_Event_Observer $observer)
    {
        $data = [
            'title' => 'Product Search Request',
            'content' => (array)$observer->getTransport(),
        ];
        $this->_registerData($data);
    }

    public function integernetSolrAfterSearchRequest(Varien_Event_Observer $observer)
    {
        $data = [
            'title' => 'Product Search Response (merged)',
            'content' => (array)$observer->getResult(),
        ];
        $this->_registerData($data);
    }

    /**
     * @param array $data
     */
    protected function _registerData($data)
    {
        $responses = Mage::registry('integernet_solr_data');
        if (!$responses) {
            $responses = [];
        }
        $responses[] = $data;

        Mage::unregister('integernet_solr_data');
        Mage::register('integernet_solr_data', $responses);
    }
}