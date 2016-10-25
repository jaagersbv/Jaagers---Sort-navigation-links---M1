<?php
$installer = $this;
$installer->startSetup();
$installer->getConnection()
	->addColumn($installer->getTable('jaagers_sortnavigationlinks'), 'name', array(
		'type' 		=> Varien_Db_Ddl_Table::TYPE_TEXT,
		'length'	=> '64',
		'comment' 	=> 'Name'
	));
$installer->endSetup();
