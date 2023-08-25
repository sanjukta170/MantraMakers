<?php
namespace MantraMakers\OmniTranslate\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class IsTranslate implements OptionSourceInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => 'No' ],
            ['value' => 1, 'label' => 'Yes'],
        ];
    }

}
