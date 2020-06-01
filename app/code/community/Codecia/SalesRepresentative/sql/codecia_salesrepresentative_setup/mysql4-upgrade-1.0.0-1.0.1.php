<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$connection = $installer->getConnection();

$installer->startSetup();

$tableSales = $this->getTable('sales_flat_order');

if ($connection->tableColumnExists($tableSales, 'sales_representative_id') === false) {
    $connection->addColumn(
        $tableSales,
        'sales_representative_id',
        'varchar(255) Default Null'
    );
}

$installer->endSetup();

