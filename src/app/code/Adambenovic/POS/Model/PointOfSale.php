<?php

namespace Adambenovic\POS\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class PointOfSale extends AbstractModel implements IdentityInterface
{
    public const CACHE_TAG = 'adambenovic_pos_point_of_sale';

    protected $cacheTag = self::CACHE_TAG;

    protected $eventPrefix = self::CACHE_TAG;

    protected function _construct()
    {
        $this->_init(ResourceModel\PointOfSale::class);
    }

    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues(): array
    {
        return [];
    }
}
