<?php

class Jaagers_Sortnavigationlinks_Adminhtml_Sortnavigationlinks_NavigationlinksController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu("sortnavigationlinks/navigationlinks")->_addBreadcrumb(Mage::helper("adminhtml")->__("Navigationlinks  Manager"),Mage::helper("adminhtml")->__("Navigationlinks Manager"));
		return $this;
	}

	public function indexAction()
	{
		$this->_title($this->__("Sortnavigationlinks"));
		$this->_title($this->__("Manager Navigationlinks"));

		$this->_initAction();
		$this->renderLayout();
	}

	public function editAction()
	{
		$this->_title($this->__("Sortnavigationlinks"));
		$this->_title($this->__("Navigationlinks"));
		$this->_title($this->__("Edit Item"));

		$id = $this->getRequest()->getParam("id");
		$model = Mage::getModel("sortnavigationlinks/navigationlinks")->load($id);
		if ($model->getId()) {
			Mage::register("navigationlinks_data", $model);
			$this->loadLayout();
			$this->_setActiveMenu("sortnavigationlinks/navigationlinks");
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Navigationlinks Manager"), Mage::helper("adminhtml")->__("Navigationlinks Manager"));
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Navigationlinks Description"), Mage::helper("adminhtml")->__("Navigationlinks Description"));
			$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock("sortnavigationlinks/adminhtml_navigationlinks_edit"))->_addLeft($this->getLayout()->createBlock("sortnavigationlinks/adminhtml_navigationlinks_edit_tabs"));
			$this->renderLayout();
		}
		else {
			Mage::getSingleton("adminhtml/session")->addError(Mage::helper("sortnavigationlinks")->__("Item does not exist."));
			$this->_redirect("*/*/");
		}
	}
	
	public function saveAction()
	{
		$post_data=$this->getRequest()->getPost();
		if ($post_data) {

			try {

				$post_data['enabled'] = isset($post_data['enabled']) ? 1 : 0;

				$model = Mage::getModel("sortnavigationlinks/navigationlinks")
				->addData($post_data)
				->setId($this->getRequest()->getParam("id"))
				->save();

				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Navigationlinks was successfully saved"));
				Mage::getSingleton("adminhtml/session")->setNavigationlinksData(false);

				if ($this->getRequest()->getParam("back")) {
					$this->_redirect("*/*/edit", array("id" => $model->getId()));
					return;
				}
				$this->_redirect("*/*/");
				return;
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				Mage::getSingleton("adminhtml/session")->setNavigationlinksData($this->getRequest()->getPost());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
			return;
			}

		}
		$this->_redirect("*/*/");
	}

	public function deleteAction()
	{
		if( $this->getRequest()->getParam("id") > 0 ) {
			try {
				$model = Mage::getModel("sortnavigationlinks/navigationlinks");
				$model->setId($this->getRequest()->getParam("id"))->delete();
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
				$this->_redirect("*/*/");
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
			}
		}
		$this->_redirect("*/*/");
	}

	public function massEnableAction()
	{
		try {
			$ids = $this->getRequest()->getPost('entity_ids', array());
			foreach ($ids as $id) {
				$model = Mage::getModel("sortnavigationlinks/navigationlinks");
				$model->setId($id)->setData('enabled', true)->save();
			}
			Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) successfully enabled"));
		} catch (Exception $e) {
			Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
		}
		$this->_redirect('*/*/');
	}

	public function massDisableAction()
	{
		try {
			$ids = $this->getRequest()->getPost('entity_ids', array());
			foreach ($ids as $id) {
				$model = Mage::getModel("sortnavigationlinks/navigationlinks");
				$model->setId($id)->setData('enabled', false)->save();
			}
			Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) successfully disabled"));
		} catch (Exception $e) {
			Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
		}
		$this->_redirect('*/*/');
	}

}
