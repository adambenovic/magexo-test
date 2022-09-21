<?php

namespace Adambenovic\POS\Controller\Adminhtml\POS;

use Adambenovic\POS\Controller\Adminhtml\PointOfSale;
use Adambenovic\POS\Model\PointOfSaleFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class Save extends PointOfSale
{
    protected Session $backendSession;

    public function __construct(
        Session $backendSession,
        PointOfSaleFactory $posFactory,
        Registry $registry,
        RedirectFactory $resultRedirectFactory,
        Context $context
    ) {
        $this->backendSession = $backendSession;
        parent::__construct($posFactory, $registry, $resultRedirectFactory, $context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPost('PointOfsale');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $pos = $this->_initPointOfSale();
            $pos->setData($data);
            $this->_eventManager->dispatch(
                'adambenovic_pos_point_of_sale_prepare_save',
                [
                    'pos' => $pos,
                    'request' => $this->getRequest()
                ]
            );

            try {
                $pos->save();
                $this->messageManager->addSuccess(__('The Point Of Sale has been saved.'));
                $this->backendSession->setAdambenovicPosPointOfSaleData(false);

                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'adambenovic_pos/*/edit',
                        [
                            'pos_id' => $pos->getId(),
                            '_current' => true
                        ]
                    );

                    return $resultRedirect;
                }

                $resultRedirect->setPath('adambenovic_pos/*/');

                return $resultRedirect;
            } catch (LocalizedException | \RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Post.'));
            }

            $this->_getSession()->setAdambenovicPosPointOfSaleData($data);
            $resultRedirect->setPath(
                'adambenovic_pos/*/edit',
                [
                    'pos_id' => $pos->getId(),
                    '_current' => true
                ]
            );

            return $resultRedirect;
        }

        $resultRedirect->setPath('adambenovic_pos/*/');

        return $resultRedirect;
    }
}
