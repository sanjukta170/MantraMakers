<?php

namespace MantraMakers\OmniTranslate\Model;

use Magento\Framework\File\Csv;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel\Collection;
use MantraMakers\OmniTranslate\Model\TranslateModel;

class CsvImport
{
    protected $csvProcessor;
    private Collection $resourceModel;
    private \MantraMakers\OmniTranslate\Model\TranslateModel $translateModel;

    public function __construct(
        Csv $csvProcessor,
        Collection $resourceModel,
        TranslateModel $translateModel
    ) {
        $this->csvProcessor = $csvProcessor;
        $this->resourceModel = $resourceModel;
        $this->translateModel = $translateModel;
    }

    public function importCsv($filePath)
    {
        $data = $this->csvProcessor->getData($filePath);
        $model = $this->translateModel;
        foreach ($data as $row) {
            $model->setData([
                'store_id' => $row['store_id'],
                'targetvalue' => $row['targetvalue'],
                'translationvalue' => $row['translationvalue'],
                'classname' => $row['classname'],
                'targetvaluetype' => $row['targetvaluetype'],
                'isautotranslate' => 'no', // Always set to 'no'
            ]);
            $this->resourceModel->save($model);
        }
    }
}
