<?php

namespace Adambenovic\POS\Controller\Adminhtml\POS;

use Adambenovic\POS\Controller\Adminhtml\PointOfSale;

class Delete extends PointOfSale
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('pos_id');

        if ($id) {
            try {
                $pos = $this->posFactory->create();
                $pos->load($id);
                $pos->delete();
                $this->messageManager->addSuccess(__('The Point Of Sale has been deleted.'));
                $resultRedirect->setPath('adambenovic_pos/*/');

                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $resultRedirect->setPath('adambenovic_pos/*/edit', ['pos_id' => $id]);

                return $resultRedirect;
            }
        }

        $this->messageManager->addError(__('Point Of Sale was not found.'));
        $resultRedirect->setPath('adambenovic_pos/*/');

        return $resultRedirect;
    }
}
