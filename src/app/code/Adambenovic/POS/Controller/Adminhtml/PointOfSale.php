<?php

namespace Adambenovic\POS\Controller\Adminhtml;

use Adambenovic\POS\Model\PointOfSaleFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\Registry;

abstract class PointOfSale extends Action
{
    protected PointOfSaleFactory $posFactory;

    protected Registry $coreRegistry;

    protected $resultRedirectFactory;

    public function __construct(
        PointOfSaleFactory $posFactory,
        Registry $coreRegistry,
        RedirectFactory $resultRedirectFactory,
        Context $context
    ) {
        $this->posFactory = $posFactory;
        $this->coreRegistry = $coreRegistry;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    protected function _initPointOfSale()
    {
        $posId = (int)$this->getRequest()->getParam('pos_id');
        $pos = $this->posFactory->create();

        if ($posId) {
            $pos->load($posId);
        }

        $this->coreRegistry->register('adambenovic_pos_point_of_sale', $pos);

        return $pos;
    }
}
