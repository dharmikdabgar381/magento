<?php
class Ccc_Practice_Model_Resource_Practice_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('practice/practice');
    }
    public function test()
    {
        return $this;
    }
    public function test2()
    {
        echo "string";
    }

}