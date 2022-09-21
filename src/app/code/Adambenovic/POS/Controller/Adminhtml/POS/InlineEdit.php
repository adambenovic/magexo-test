<?php

namespace Adambenovic\POS\Controller\Adminhtml\POS;

use Adambenovic\POS\Model\PointOfSale;
use Adambenovic\POS\Model\PointOfSaleFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

abstract class InlineEdit extends Action
{
    protected JsonFactory $jsonFactory;

    protected PointOfSaleFactory $posFactory;

    public function __construct(
        JsonFactory $jsonFactory,
        PointOfSaleFactory $postFactory,
        Context $context
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->posFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $posItems = $this->getRequest()->getParam('items', []);

        if (!($this->getRequest()->getParam('isAjax') && count($posItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($posItems) as $posId) {
            $pos = $this->posFactory->create()->load($posId);
            try {
                $posData = $posItems[$posId];
                $pos->addData($posData);
                $pos->save();
            } catch (LocalizedException | \RuntimeException $e) {
                $messages[] = $this->getErrorWithPosId($pos, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithPosId(
                    $pos,
                    __('Something went wrong while saving the Point Of Sale.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    protected function getErrorWithPosId(PointOfSale $pos, $errorText)
    {
        return '[Point Of Sale ID: ' . $pos->getId() . '] ' . $errorText;
    }
}
