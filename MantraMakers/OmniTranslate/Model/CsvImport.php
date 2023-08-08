<?php

namespace MantraMakers\OmniTranslate\Model;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\File\Csv;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel\Collection;
use MantraMakers\OmniTranslate\Model\TranslateModel;

class CsvImport
{
    protected $csvProcessor;
    private Collection $resourceModel;
    private TranslateModel $translateModel;
    private ResultFactory $resultFactory;

    public function __construct(
        Csv $csvProcessor,
        Collection $resourceModel,
        TranslateModel $translateModel,
        ResultFactory $resultFactory
    ) {
        $this->csvProcessor = $csvProcessor;
        $this->resourceModel = $resourceModel;
        $this->translateModel = $translateModel;
        $this->resultFactory = $resultFactory;
    }

    public function importCsv($filePath)
    {
        $data = $this->csvProcessor->getData($filePath);
        $model = $this->translateModel;
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $currentUrl = $this->url->getCurrentUrl();
        foreach ($data as $row) {
            $model->setData([
                'store_id' => $row['store_id'],
                'targetvalue' => $row['targetvalue'],
                'translationvalue' => $row['translationvalue'],
                'classname' => $row['classname'],
                'targetvaluetype' => $row['targetvaluetype'],
                'isautotranslate' => 'no', // Always set to 'no'
            ]);
        }
        try{
        $this->resourceModel->save($model);

        $this->messageManager->addSuccessMessage(__('New Translation created successfully.'));
            return $redirect->setPath('*/*/');
        } catch (\Exception $e){
            $this->messageManager->addErrorMessage($e->getMessage());
            $redirect->setUrl($currentUrl);
        }
    }
}
