<?php

namespace MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MantraMakers\OmniTranslate\Model\TranslateModel;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(TranslateModel::class, ResourceModel::class);
    }
}
