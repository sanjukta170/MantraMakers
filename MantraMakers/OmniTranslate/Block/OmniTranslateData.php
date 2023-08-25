<?php

namespace MantraMakers\OmniTranslate\Block;

use Magento\Framework\View\Element\Template;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel\Collection;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class OmniTranslateData extends Template
{

    /**
     * @var Collection
     */
    private Collection $translateModel;
    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;
    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    public function __construct(
        Template\Context $context,
        Collection $translateModel,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->translateModel = $translateModel;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array|null
     */
    public function getTranslateData()
    {
        if ($this->getEnableModule()) {
            return $this->translateModel->addFilter('store_id', $this->getCurrentStoreId())->getData();
        } else {
            return null;
        }
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrentStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    public function getEnableModule() {
        return $this->scopeConfig->getValue("mantramakers_omnitranslate/general/enabled",
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,$this->getCurrentStoreId());
    }
}
