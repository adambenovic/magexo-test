<?php
namespace Adambenovic\POS\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PointOfSale extends AbstractDb
{
    public const TABLE_NAME = 'adambenovic_pos_point_of_sale';

    public const ID_FIELD_NAME = 'pos_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::ID_FIELD_NAME);
    }
}
