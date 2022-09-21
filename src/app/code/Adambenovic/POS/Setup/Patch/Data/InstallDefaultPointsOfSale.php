<?php

namespace Adambenovic\POS\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Adambenovic\POS\Model\PointOfSaleFactory;

class InstallDefaultPointsOfSale implements DataPatchInterface, PatchVersionInterface
{
    private PointOfsaleFactory $posFactory;

    public function __construct(PointOfSaleFactory $posFactory)
    {
        $this->posFactory = $posFactory;
    }

    public function apply(): InstallDefaultPointsOfSale|static
    {
        for ($i = 1; $i <= 100; $i++) {
            $pos = $this->posFactory->create();
            $pos->setName( 'Point Of Sale ' . $i);
            $pos->setAddress('Address ' . $i);
            $pos->setIsAvailable($i % 2 === 0);
            $pos->save();
        }

        return $this;
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public static function getVersion(): string
    {
        return '1.0.1';
    }

    public function getAliases(): array
    {
        return [];
    }
}
