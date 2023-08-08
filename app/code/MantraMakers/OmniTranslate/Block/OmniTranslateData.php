<?php

namespace MantraMakers\OmniTranslate\Block;

use Magento\Framework\View\Element\Template;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel\Collection;
use Magento\Store\Model\StoreManagerInterface;

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

    public function __construct(
        Template\Context $context,
        Collection $translateModel,
        StoreManagerInterface $storeManager,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->translateModel = $translateModel;
        $this->storeManager = $storeManager;
    }


    public function getTranslateData()
    {
        return $this->translateModel->addFilter('store_id', $this->getCurrentStoreId() )->getData();
    }

    public function getCurrentStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }
}
