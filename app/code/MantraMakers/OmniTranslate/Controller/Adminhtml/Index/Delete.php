<?php

namespace MantraMakers\OmniTranslate\Controller\Adminhtml\Index;

use MantraMakers\OmniTranslate\Model\TranslateModelFactory;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel as ResModel;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Message\Manager;

class Delete implements ActionInterface
{
    private $translateModelFactory;
    private $resourceModel;
    private $request;
    private $resultFactory;
    private $messageManager;

    public function __construct(
        TranslateModelFactory $translateModelFactory,
        ResModel $resourceModel,
        RequestInterface $request,
        ResultFactory $resultFactory,
        Manager $messageManager
    )
    {
        $this->translateModelFactory = $translateModelFactory;
        $this->request = $request;
        $this->resultFactory = $resultFactory;
        $this->resourceModel = $resourceModel;
        $this->messageManager = $messageManager;
    }

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->request->getParam('translate_id');
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($id) {
            try {
                $model = $this->translateModelFactory->create();
                $this->resourceModel->load($model, $id);
                $this->resourceModel->delete($model);
                $this->messageManager->addSuccessMessage(__('Translation deleted successfully.'));
                return $redirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirect->setPath('*/*/edit', ['translate_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Translation does not exist.'));
        return $redirect->setPath('*/*/');
    }
}
