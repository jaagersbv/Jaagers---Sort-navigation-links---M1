<?php

class Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

	public function __construct()
	{
		parent::__construct();
		$this->setId("navigationlinksGrid");
		$this->setDefaultSort("entity_id");
		$this->setDefaultDir("DESC");
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel("sortnavigationlinks/navigationlinks")->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

    protected function _getAttributeOptions($attributeName)
	{
        $collection = Mage::getModel("sortnavigationlinks/navigationlinks")->getCollection();
        /* @var $attribute Mage_Catalog_Model_Resource_Eav_Attribute */

        $options = array();

        foreach($collection as $item)
        {
            $options[$item->getData('code')] = $item->getName();
        }

        return $options;
    }

	protected function _prepareColumns()
	{
		$this->addColumn("entity_id", array(
			"header" => Mage::helper("sortnavigationlinks")->__("ID"),
			"align" =>"right",
			"width" => "40px",
			"type" => "number",
			"index" => "entity_id",
		));
		$this->addColumn("name", array(
			"header" => Mage::helper("sortnavigationlinks")->__("Name"),
			"index" => "name",
		));
		$this->addColumn("sort", array(
			"header" => Mage::helper("sortnavigationlinks")->__("Sort"),
			"index" => "sort",
			"width" => "200px"
		));
		$stores = Mage::getModel('core/store')->getCollection()->toOptionArray();
		foreach($stores as $store) {
			$newStores[$store['value']] = $store['label'];
		}
		$this->addColumn("store_id", array(
			"header" => Mage::helper("sortnavigationlinks")->__("Store ID"),
			"index" => "store_id",
			"width" => "200px",
			"type" => 'options',
			'options' => $newStores,
			"renderer" => 'Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks_Renderer_Storeid'
		));
		$this->addColumn("enabled", array(
			"header" => Mage::helper("sortnavigationlinks")->__("Enabled"),
			"index" => "enabled",
			"width" => "100px",
			"type" => 'options',
			'options' => array('0' => 'Disabled', '1' => 'Enabled'),
			"renderer" => 'Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks_Renderer_Enabled'
		));
		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
	}

	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('entity_id');
		$this->getMassactionBlock()->setFormFieldName('entity_ids');
		$this->getMassactionBlock()->setUseSelectAll(true);
		$this->getMassactionBlock()->addItem('enable_navigationlinks', array(
			'label'=> Mage::helper('sortnavigationlinks')->__('Enable Link'),
			'url'  => $this->getUrl('*/adminhtml_navigationlinks/massEnable'),
			'confirm' => Mage::helper('sortnavigationlinks')->__('Are you sure?')
		));
		$this->getMassactionBlock()->addItem('disable_navigationlinks', array(
			'label'=> Mage::helper('sortnavigationlinks')->__('Disable Link'),
			'url'  => $this->getUrl('*/adminhtml_navigationlinks/massDisable'),
			'confirm' => Mage::helper('sortnavigationlinks')->__('Are you sure?')
		));
		return $this;
	}

}