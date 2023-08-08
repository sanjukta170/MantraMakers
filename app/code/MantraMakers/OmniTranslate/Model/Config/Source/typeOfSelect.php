<?php
namespace MantraMakers\OmniTranslate\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class typeOfSelect implements OptionSourceInterface
{
    /**
     * @return \string[][]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'html', 'label' => 'html' ],
            ['value' => 'text', 'label' => 'text'],
        ];
    }

}
