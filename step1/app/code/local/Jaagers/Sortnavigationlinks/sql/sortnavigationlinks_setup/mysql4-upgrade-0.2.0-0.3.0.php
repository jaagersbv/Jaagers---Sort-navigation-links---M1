<?php
$installer = $this;
$installer->startSetup();
$installer->getConnection()
	->addColumn($installer->getTable('jaagers_sortnavigationlinks'), 'enabled', array(
		'type' 		=> Varien_Db_Ddl_Table::TYPE_INTEGER,
		'length'  	=> 11,
		'nullable' 	=> true,
		'default' 	=> '1',
		'comment' 	=> 'Enabled'
	));
$installer->endSetup();