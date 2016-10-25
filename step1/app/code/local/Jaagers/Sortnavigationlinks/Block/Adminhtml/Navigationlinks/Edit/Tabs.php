<?php
class Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
		parent::__construct();
		$this->setId("navigationlinks_tabs");
		$this->setDestElementId("edit_form");
		$this->setTitle(Mage::helper("sortnavigationlinks")->__("Item Information"));
	}
	protected function _beforeToHtml()
	{
		$this->addTab("form_section", array(
			"label" => Mage::helper("sortnavigationlinks")->__("Item Information"),
			"title" => Mage::helper("sortnavigationlinks")->__("Item Information"),
			"content" => $this->getLayout()->createBlock("sortnavigationlinks/adminhtml_navigationlinks_edit_tab_form")->toHtml(),
		));
		return parent::_beforeToHtml();
	}
}
