<?php
class Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks_Renderer_Storeid extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

	public function render(Varien_Object $row)
	{
		$value =  $row->getData($this->getColumn()->getIndex());
		$store = Mage::getModel('core/store')->load($value);
		return $store->getName();
	}

}