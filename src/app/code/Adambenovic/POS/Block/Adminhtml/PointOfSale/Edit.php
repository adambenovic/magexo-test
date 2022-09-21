<?php

namespace Adambenovic\POS\Block\Adminhtml\PointOfSale;

use Adambenovic\POS\Model\ResourceModel\PointOfSale;
use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

class Edit extends Container
{
    protected Registry $coreRegistry;

    public function __construct(
        Registry $coreRegistry,
        Context $context,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize Post edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = PointOfSale::ID_FIELD_NAME;
        $this->_blockGroup = 'Adambenovic_POS';
        $this->_controller = 'adminhtml_pos';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Point Of Sale'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Point Of Sale'));
    }

    public function getHeaderText(): Phrase|string
    {
        $pos = $this->coreRegistry->registry('adambenov_pos_point_of_sale');

        if ($pos->getId()) {
            return __("Edit Point Of Sale '%1'", $this->escapeHtml($pos->getName()));
        }

        return __('New Point Of Sale');
    }
}
