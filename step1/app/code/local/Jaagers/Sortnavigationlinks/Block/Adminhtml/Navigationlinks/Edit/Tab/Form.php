<?php
class Jaagers_Sortnavigationlinks_Block_Adminhtml_Navigationlinks_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $checked = false;

        if (Mage::registry("navigationlinks_data")) {
            $model = Mage::registry("navigationlinks_data")->getData();
            $checked = $model['enabled'] == 1 ? true : false;
        }

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("sortnavigationlinks_form", array("legend" => Mage::helper("sortnavigationlinks")->__("Item information")));

        $fieldset->addField("code", "text", array(
            "label" => Mage::helper("sortnavigationlinks")->__("Code"),
            "class" => "required-entry",
            "required" => true,
            "name" => "code",
            "disabled" => true,
            "after_element_html" => '<small>' . ' This field is read-only ' . '</small>'
        ));

        $fieldset->addField("sort", "text", array(
            "label" => Mage::helper("sortnavigationlinks")->__("sort"),
            "class" => "required-entry validate-number validate-number-range number-range-0-10000",
            "required" => true,
            "name" => "sort",
            "after_element_html" => '<small>' . ' Please provide a valid number, between 0-10000 ' . '</small>'
        ));

        $fieldset->addField("enabled", "checkbox", array(
            "label" => Mage::helper("sortnavigationlinks")->__("enabled"),
            'onclick' => 'this.value = this.checked ? 1 : 0;',
            "name" => "enabled",
            'checked' =>    $checked,
            'value' => '1'
        ));

        if (Mage::getSingleton("adminhtml/session")->getNavigationlinksData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getNavigationlinksData());
            Mage::getSingleton("adminhtml/session")->setNavigationlinksData(null);
        } elseif (Mage::registry("navigationlinks_data")) {
            $form->setValues(Mage::registry("navigationlinks_data")->getData());
        }
        return parent::_prepareForm();
    }
}
