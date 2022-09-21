<?php

namespace Adambenovic\POS\Block\Adminhtml\PointOfSale\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

class PointOfSale extends Generic implements TabInterface
{
    protected Yesno $booleanOptions;

    public function __construct(
        Yesno $booleanOptions,
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        array $data = []
    ) {
        $this->booleanOptions = $booleanOptions;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $pos = $this->_coreRegistry->registry('adambenovic_pos_point_of_sale');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('PointOfSale_');
        $form->setFieldNameSuffix('PointOfsale');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Point Of Sale Info'),
                'class'  => 'fieldset-wide'
            ]
        );

        if ($pos->getId()) {
            $fieldset->addField(
                \Adambenovic\POS\Model\ResourceModel\PointOfSale::ID_FIELD_NAME,
                'hidden',
                ['name' => \Adambenovic\POS\Model\ResourceModel\PointOfSale::ID_FIELD_NAME]
            );
        }

        $fieldset->addField(
                'name',
                'text',
                [
                    'name'  => 'name',
                    'label' => __('Name'),
                    'title' => __('Name'),
                    'required' => true,
                ]
            );
        $fieldset->addField(
                'address',
                'text',
                [
                    'name'  => 'address',
                    'label' => __('Address'),
                    'title' => __('Address'),
                    'required' => true,
                ]
            );
            $fieldset->addField(
                'is_available',
                'select',
                [
                    'name'  => 'is_available',
                    'label' => __('Is available?'),
                    'title' => __('Is available?'),
                    'values' => $this->booleanOptions->toOptionArray(),
                ]
            );

        $posData = $this->_session->getData(' adambenovic_pos_pos_data', true);

        if ($posData) {
            $pos->addData($posData);
        } elseif (!$pos->getId()) {
            $pos->addData($pos->getDefaultValues());
        }

        $form->addValues($pos->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getTabLabel(): Phrase|string
    {
        return __('Point Of Sale');
    }

    public function getTabTitle(): Phrase|string
    {
        return $this->getTabLabel();
    }

    public function canShowTab(): bool
    {
        return true;
    }

    public function isHidden(): bool
    {
        return false;
    }
}
