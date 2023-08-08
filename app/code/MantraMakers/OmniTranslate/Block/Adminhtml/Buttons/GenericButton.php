<?php

namespace MantraMakers\OmniTranslate\Block\Adminhtml\Buttons;

use Magento\Backend\Block\Widget\Context;

/**
 * Class GenericButton
 * @package Aaw\Employee\Block\Adminhtml\Buttons
 */
class GenericButton
{
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
    }


    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = []) : string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
