<?php

class Codecia_SalesRepresentative_Model_Source_Roles{

    protected $_roles = array();

    public function toOptionArray()
    {
        $roles = Mage::getModel('admin/roles')->getCollection();
        $this->_roles[] = array(
            'value' => '',
            'label' => ''
        );
        foreach($roles as $role)
        {
            $this->_roles[] = array(
                'label' => $role->getRoleName(),
                'value' => $role->getId()
            );
        }
        return $this->_roles;
    }
}