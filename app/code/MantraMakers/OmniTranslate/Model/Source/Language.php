<?php

namespace MantraMakers\OmniTranslate\Model\Source;

use Magento\Framework\Locale\Deployed\Options;
use Magento\Framework\Data\OptionSourceInterface;
/**
 *
 */
class Language  implements OptionSourceInterface
{
    /**
     * @var Options
     */
    private Options $availableLocales;

    /**
     * Language constructor.
     * @param Options $availableLocales
     */
    public function __construct(
        Options $availableLocales
    )
    {
        $this->availableLocales = $availableLocales;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return $this->availableLocales->getOptionLocales();
    }
}
