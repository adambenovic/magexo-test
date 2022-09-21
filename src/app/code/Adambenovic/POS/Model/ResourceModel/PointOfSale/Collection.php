<?php

namespace Adambenovic\POS\Model\ResourceModel\PointOfSale;

use Adambenovic\POS\Model\ResourceModel\PointOfSale as ResourceModelPointOfSale;
use Adambenovic\POS\Model\PointOfSale as ModelPointOfSale;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = ResourceModelPointOfSale::ID_FIELD_NAME;
    protected $_eventPrefix = ResourceModelPointOfSale::TABLE_NAME . '_collection';
    protected $_eventObject = 'pos_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ModelPointOfSale::class, ResourceModelPointOfSale::class);
    }
}
