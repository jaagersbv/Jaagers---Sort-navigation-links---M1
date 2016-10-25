<?php
class Jaagers_Sortnavigationlinks_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation
{
    public function removeLinkByName($name)
    {
        unset($this->_links[$name]);
    }

    public function addLink($name, $path, $label, $urlParams=array(), $sort = 0)
    {
        $this->_links[] = new Varien_Object(array(
            'name'      => $name,
            'path'      => $path,
            'label'     => $label,
            'url'       => $this->getUrl($path, $urlParams),
            'sort'      => $sort
        ));

        return $this;
    }

    function cmp($a, $b)
    {
        return $a->getData('sort') - $b->getData('sort');
    }

    var $filtered_links = null;

    public function getLinks()
    {
        if(!isset($this->filtered_links)) {
            foreach ($this->_links as $key => $link) {

                $storeId = Mage::app()->getStore()->getStoreId();

                $model = Mage::getModel('sortnavigationlinks/navigationlinks')
                    ->getCollection()
                    ->addFieldToFilter('code', $link['name'])
                    ->addFieldToFilter('store_id', $storeId)
                    ->getFirstItem();

                if (!$model->getId()) {

                    $model->setData(
                        array(
                            'store_id' => $storeId,
                            'name' => $link['label'],
                            'code' => $link['name'],
                            'sort' => '10000',
                            'enabled' => '1'
                        )
                    )->save();

                }

                $enabled = $model->getEnabled() == "1" ? true : false;

                if ($enabled) {
                    $link['sort'] = $model->getSort();
                    $this->filtered_links[$key] = $link;
                }
            }

            usort($this->filtered_links, array($this, 'cmp'));
        }

        return $this->filtered_links;
    }
}