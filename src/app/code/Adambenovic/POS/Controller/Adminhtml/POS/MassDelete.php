<?php

namespace Adambenovic\POS\Controller\Adminhtml\POS;

use Adambenovic\POS\Model\ResourceModel\PointOfSale\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    protected Filter $filter;

    protected CollectionFactory $collectionFactory;

    public function __construct(
        Filter $filter,
        CollectionFactory $collectionFactory,
        Context $context
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        foreach ($collection as $item) {
            $item->delete();
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', count($collection)));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }
}
