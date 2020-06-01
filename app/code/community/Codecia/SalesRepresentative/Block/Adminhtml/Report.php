<?php

class Codecia_SalesRepresentative_Block_Adminhtml_Report extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'codecia_salesrepresentative';
        $this->_controller = 'adminhtml_report';
        $this->_headerText = $this->__('Relatório de Representante');

        parent::__construct();
        $this->removeButton('add');
    }

}
