<?php

class Codecia_SalesRepresentative_Model_Resource_Report_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('codecia_salesrepresentative/report');
    }
}
