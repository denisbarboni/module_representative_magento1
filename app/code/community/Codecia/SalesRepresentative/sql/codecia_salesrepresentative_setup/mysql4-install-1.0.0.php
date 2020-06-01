<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$tableReport = $installer->getTable('codecia_salesrepresentative/report');
if(!$installer->tableExists($tableReport)){
    $table = $installer->getConnection()
        ->newTable($tableReport)
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'ID')
        ->addColumn('representative_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'nullable'  => false,
        ), 'ID do Representante')
        ->addColumn('representative_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable'  => false,
        ), 'ID do Representante')
        ->addColumn('representative_email', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable'  => false,
        ), 'ID do Representante')
        ->addColumn('order_increment_id', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable'  => false,
        ), 'ID Incremental do Pedido')
        ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'nullable'  => false,
        ), 'ID Cliente')
        ->addColumn('customer_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable'  => false,
        ), 'Nome do Cliente')
        ->addColumn('customer_email', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable'  => false,
        ), 'Email do Cliente')
        ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array())
        ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array())
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('representative_id')),
            array('representative_id'),
            array('type' => 'index')
        )
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('representative_name')),
            array('representative_name'),
            array('type' => 'index')
        )
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('representative_email')),
            array('representative_email'),
            array('type' => 'index')
        )
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('order_increment_id')),
            array('order_increment_id'),
            array('type' => 'index')
        )
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('customer_id')),
            array('customer_id'),
            array('type' => 'index')
        )
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('customer_name')),
            array('customer_name'),
            array('type' => 'index')
        )
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('customer_email')),
            array('customer_email'),
            array('type' => 'index')
        )
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('customer_email')),
            array('customer_email'),
            array('type' => 'index')
        )
        ->addIndex(
            $installer->getConnection()->getIndexName($tableReport, array('updated_at')),
            array('updated_at'),
            array('type' => 'index')
        );

    $installer->getConnection()->createTable($table);
}

$installer->endSetup();

