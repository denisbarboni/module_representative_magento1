<?php

class Codecia_SalesRepresentative_Block_Adminhtml_Report_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('codecia_salesrepresentative_report_grid');
        $this->setDefaultSort('id');
        $this->setSaveParametersInSession(true);
    }


    protected function _prepareCollection()
    {
        /** @var Codecia_SalesRepresentative_Model_Resource_Report_Collection $collection */
        $collection = Mage::getModel('codecia_salesrepresentative/report')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header'    => 'ID',
            'width'     => '50',
            'index'     => 'id',
            'type'      => 'number',
        ));

        $this->addColumn('representative_name', array(
            'header'    => 'Nome do Representante',
            'width'     => '150',
            'index'     => 'representative_name'
        ));

        $this->addColumn('representative_email', array(
            'header'    => 'Email do Representante',
            'width'     => '150',
            'index'     => 'representative_email'
        ));

        $this->addColumn('order_increment_id', array(
            'header'    => 'Número do Pedido',
            'width'     => '150',
            'index'     => 'order_increment_id'
        ));

        $this->addColumn('customer_name', array(
            'header'    => 'Nome do Cliente',
            'width'     => '150',
            'index'     => 'customer_name'
        ));

        $this->addColumn('customer_email', array(
            'header'    => 'Email do Cliente',
            'width'     => '150',
            'index'     => 'customer_email'
        ));

        $this->addColumn('created_at', array(
            'header'    => 'Data de Criação',
            'width'     => '150',
            'index'     => 'created_at'
        ));

        $this->addExportType('*/*/exportCsv', 'CSV');
        $this->addExportType('*/*/exportXml', 'Excel XML');
        return parent::_prepareColumns();
    }


    public function getRowUrl($row)
    {
        return false;
    }
}
