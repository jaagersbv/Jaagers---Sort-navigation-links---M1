<?php
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('jaagers_sortnavigationlinks'))
	->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 10, array(
		'unsigned' => true,
		'nullable' => false,
		'primary' => true,
		'identity' => true,
	), 'Entity ID')
	->addColumn('code', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
		'nullable' => false,
		'default' => '',
	), 'Title')
	->addColumn('sort', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => false,
		'default' => '',
	), 'Short Desc')
	->setComment('Articles table');
$installer->getConnection()->createTable($table);
$installer->endSetup();
