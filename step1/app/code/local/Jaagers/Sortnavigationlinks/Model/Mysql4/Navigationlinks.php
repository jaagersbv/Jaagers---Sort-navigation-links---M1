<?php
class Jaagers_Sortnavigationlinks_Model_Mysql4_Navigationlinks extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("sortnavigationlinks/navigationlinks", "entity_id");
    }
}