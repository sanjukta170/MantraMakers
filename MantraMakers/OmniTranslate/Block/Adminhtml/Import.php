<?php

namespace MantraMakers\OmniTranslate\Block\Adminhtml;

use Magento\Backend\Block\Template;

class Import extends Template
{
    public function getFormAction()
    {
        return $this->getUrl('mantramakers_omnitranslate/index/import', ['_secure' => true]);
    }
}
