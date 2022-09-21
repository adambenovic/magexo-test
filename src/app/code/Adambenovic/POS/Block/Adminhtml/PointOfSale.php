<?php

namespace Adambenovic\POS\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class PointOfSale extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_pos';
        $this->_blockGroup = 'Adambenovic_POS';
        $this->_headerText = __('Points Of Sale');
        $this->_addButtonLabel = __('Create New Point Of Sale');
        parent::_construct();
    }
}
