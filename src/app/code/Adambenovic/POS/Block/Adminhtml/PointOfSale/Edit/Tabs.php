<?php

namespace Adambenovic\POS\Block\Adminhtml\PointOfSale\Edit;

/**
 * @method Tabs setTitle(\string $title)
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('pos_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Point Of Sale Info'));
    }
}
