<?php

class Codecia_SalesRepresentative_Helper_Data extends Mage_Core_Helper_Abstract {


   public function isActive()
   {
       return Mage::getStoreConfig('codecia_salesrepresentative/settings/active');
   }

   public function getConfig($key)
   {
       if ($this->getConfig('active_log'))
       {
           return Mage::getStoreConfig('codecia_salesrepresentative/settings/'.$key);
       }
   }

    public function writeLog($message)
    {
        return Mage::log($message, null, 'codecia_salesrepresentative.log');
    }

   public function verifyUserIsSalesRepresentative($user_id)
   {
       /** @var Mage_Admin_Model_Resource_Role_Collection $collection */
       $collection = Mage::getModel('admin/role')->getCollection();
       $collection->getSelect()->where("main_table.user_id = {$user_id}");
       $collection->getSelect()->limit(1);

       if ($collection->count())
       {
           $modelRole = $collection->getFirstItem();
           if ($modelRole && $modelRole->getId()){
               if ($modelRole->getParentId() == $this->getConfig('representative_role'))
               {
                   return true;
               }
           }
       }
       return false;
   }
}