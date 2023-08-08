<?php

namespace MantraMakers\OmniTranslate\Model;

use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 *
 */
class DataProvider extends AbstractDataProvider

{
    /**
     * @var
     */
    protected $loadedData;

    protected $collection;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $CollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $CollectionFactory,
        array $meta = [],
        array $data = []

    )
    {
        $this->collection = $CollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $this->loadedData[$item->getId()]['omnitranslate_information'] = $item->getData();
        }
        return $this->loadedData;

    }

}
