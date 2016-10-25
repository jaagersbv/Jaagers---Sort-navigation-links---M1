<?php
	
class Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_objectId = "entity_id";
		$this->_blockGroup = "sortnavigationlinks";
		$this->_controller = "adminhtml_navigationlinks";
		$this->_updateButton("save", "label", Mage::helper("sortnavigationlinks")->__("Save Item"));
		$this->_updateButton("delete", "label", Mage::helper("sortnavigationlinks")->__("Delete Item"));

		$this->_addButton("saveandcontinue", array(
			"label"     => Mage::helper("sortnavigationlinks")->__("Save And Continue Edit"),
			"onclick"   => "saveAndContinueEdit()",
			"class"     => "save",
		), -100);
		
		$this->_formScripts[] = "

					function saveAndContinueEdit(){
						editForm.submit($('edit_form').action+'back/edit/');
					}
				";
	}

	public function getHeaderText()
	{
		if( Mage::registry("navigationlinks_data") && Mage::registry("navigationlinks_data")->getId() ){
			return Mage::helper("sortnavigationlinks")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("navigationlinks_data")->getName()));
		} else{
			 return Mage::helper("sortnavigationlinks")->__("Add Item");
		}
	}
}