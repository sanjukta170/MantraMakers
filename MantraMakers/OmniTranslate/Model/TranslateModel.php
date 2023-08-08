<?php


namespace MantraMakers\OmniTranslate\Model;


use Magento\Framework\Model\AbstractModel;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel as ResourceModel;
use Magento\Framework\DataObject\IdentityInterface;

class TranslateModel extends AbstractModel implements TranslateModelInterface, IdentityInterface
{
    protected $_idFieldName = 'translate_id';

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getIdentities()
    {
        // TODO: Implement getIdentities() method.
    }
}
