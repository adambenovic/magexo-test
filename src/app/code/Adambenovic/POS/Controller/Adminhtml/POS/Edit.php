<?php

namespace Adambenovic\POS\Controller\Adminhtml\POS;

use Adambenovic\POS\Controller\Adminhtml\PointOfSale;
use Adambenovic\POS\Model\PointOfSaleFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends PointOfSale
{
    protected Session $backendSession;

    protected PageFactory $resultPageFactory;

    protected JsonFactory $resultJsonFactory;

    public function __construct(
        Session $backendSession,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        PointOfSaleFactory $postFactory,
        Registry $registry,
        RedirectFactory $resultRedirectFactory,
        Context $context
    ) {
        $this->backendSession = $backendSession;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($postFactory, $registry, $resultRedirectFactory, $context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('pos_id');
        $pos = $this->_initPointOfSale();
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Adambenovic_POS::pos');
        $resultPage->getConfig()->getTitle()->set(__('Points Of Sale'));

        if ($id) {
            $pos->load($id);
            if (!$pos->getId()) {
                $this->messageManager->addError(__('This Point Of Sale no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath(
                    'adambenovic_pos/*/edit',
                    [
                        'pos_id' => $pos->getId(),
                        '_current' => true
                    ]
                );

                return $resultRedirect;
            }
        }

        $title = $pos->getId() ? $pos->getName() : __('New Point Of Sale');
        $resultPage->getConfig()->getTitle()->prepend($title);
        $data = $this->backendSession->getData('adambenovic_pos_pos_data', true);

        if (!empty($data)) {
            $pos->setData($data);
        }

        return $resultPage;
    }
}
