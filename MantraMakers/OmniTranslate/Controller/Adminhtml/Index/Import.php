<?php

namespace MantraMakers\OmniTranslate\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use MantraMakers\OmniTranslate\Model\CsvImport;

class Import extends Action
{
    protected $csvImport;

    public function __construct(
        Context $context,
        CsvImport $csvImport
    ) {
        parent::__construct($context);
        $this->csvImport = $csvImport;
    }

    public function execute()
    {
        try {
            $file = $this->getRequest()->getFiles('csv_file');
            $this->csvImport->importCsv($file['tmp_name']);
            $this->messageManager->addSuccessMessage(__('CSV data has been imported.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error importing CSV: %1', $e->getMessage()));
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
}
