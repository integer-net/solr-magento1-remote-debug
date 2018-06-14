<?php
 /**
 * integer_net Magento Module
 *
 * @copyright  Copyright (c) 2018 integer_net GmbH (http://www.integer-net.de/)
 * @author     Andreas von Studnitz <avs@integer-net.de>
 */ 
class IntegerNet_SolrRemoteDebug_Model_Result_Product extends IntegerNet_Solr_Model_Result
{
    /**
     * Call Solr server twice: Once without fuzzy search, once with (if configured)
     *
     * @return \IntegerNet\Solr\Resource\SolrResponse
     */
    public function getSolrResult()
    {
        if (null === $this->_solrResult) {
            $this->_solrResult = $this->_solrRequest->doRequest($this->activeFilterAttributeCodes);
            $responses = Mage::registry('integernet_solr_responses');
            if (!$responses) {
                $responses = [];
            }
            $responses[] = $this->_solrResult->getRawResponse();

            Mage::unregister('integernet_solr_responses');
            Mage::register('integernet_solr_responses', $responses);
        }

        return $this->_solrResult;
    }
}