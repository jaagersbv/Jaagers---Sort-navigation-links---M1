<?php
class Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks_Renderer_Enabled extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

	public function render(Varien_Object $row)
	{
		$value =  $row->getData($this->getColumn()->getIndex());
		if($value == '1') {
			return '<span style="color:green;">' . $this->__('Enabled') . '</span>';
		}
		return '<span style="color:red;">' . $this->__('Disabled') . '</span>';
	}

}