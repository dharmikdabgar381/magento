<?php
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('vendor/vendor_address'))
    ->addColumn(
        'address_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity' => true,
            'nullable' => false,
            'primary' => true,
            'unsigned' => true,
        ),
        'Address ID'
    )
    ->addColumn(
        'vendor_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'nullable' => false,
            'unsigned' => true,
        ),
        'Vendor ID'
    )
    ->addColumn(
        'address',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'Address'
    )
    ->addColumn(
        'postal_code',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        10,
        array(
            'nullable' => false,
        ),
        'Postal Code'
    )
    ->addColumn(
        'city',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'City'
    )
    ->addColumn(
        'state',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'State'
    )
    ->addColumn(
        'country',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        array(
            'nullable' => false,
        ),
        'Country'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(
            'nullable' => false,
            'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
        ),
        'Created At'
    )
    ->addColumn(
        'updated_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(
            'nullable' => false,
            'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT_UPDATE,
        ),
        'Updated At'
    )
    ->addForeignKey(
        $installer->getFkName(
            'vendor/vendor_address',
            'vendor_id',
            'vendor/vendor',
            'vendor_id'
        ),
        'vendor_id',
        $installer->getTable('vendor/vendor'),
        'vendor_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );

$installer->getConnection()->createTable($table);

$installer->endSetup();
