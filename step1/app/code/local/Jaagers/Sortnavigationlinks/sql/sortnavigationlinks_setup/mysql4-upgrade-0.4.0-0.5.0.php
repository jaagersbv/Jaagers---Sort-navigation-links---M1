<?php
$installer = $this;
$installer->startSetup();
$installer->getConnection()
	->addColumn($installer->getTable('jaagers_sortnavigationlinks'), 'store_id', array(
		'type' 		=> Varien_Db_Ddl_Table::TYPE_INTEGER,
		'length'  	=> 11,
		'nullable' 	=> false,
		'default' 	=> '0',
		'comment' 	=> 'StoreId'
	));
$installer->endSetup();