<?php


class Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{
		$this->_controller = "adminhtml_navigationlinks";
		$this->_blockGroup = "sortnavigationlinks";
		$this->_headerText = Mage::helper("sortnavigationlinks")->__("Navigationlinks Manager");
		$this->_addButtonLabel = Mage::helper("sortnavigationlinks")->__("Add New Item");
		parent::__construct();
		$this->_removeButton('add');
	}

}