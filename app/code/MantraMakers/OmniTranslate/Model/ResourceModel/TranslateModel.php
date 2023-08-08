<?php


namespace MantraMakers\OmniTranslate\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class TranslateModel extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('omni_translate','translate_id');
    }
}
