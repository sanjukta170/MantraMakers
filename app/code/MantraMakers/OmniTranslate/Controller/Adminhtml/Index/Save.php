<?php

namespace MantraMakers\OmniTranslate\Controller\Adminhtml\Index;

use MantraMakers\OmniTranslate\Model\TranslateModel;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel as ResModel;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\Manager;

class Save implements ActionInterface
{
    /**
     * @var TranslateModel
     */
    private $translateModel;
    /**
     * @var ResModel
     */
    private $resourceModel;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var ResultFactory
     */
    private $resultFactory;
    /**
     * @var Manager
     */
    private $messageManager;
    /**
     * @var UrlInterface
     */
    private $url;


    public function __construct(
        TranslateModel $translateModel,
        ResModel $resourceModel,
        RequestInterface $request,
        ResultFactory $resultFactory,
        Manager $messageManager,
        UrlInterface $url
    )
    {
        $this->translateModel = $translateModel;
        $this->request = $request;
        $this->resultFactory = $resultFactory;
        $this->resourceModel = $resourceModel;
        $this->messageManager = $messageManager;
        $this->url = $url;
    }

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $data = $this->request->getParam("omnitranslate_information");
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if($data){
            $currentUrl = $this->url->getCurrentUrl();
            $model = $this->translateModel;
            $flag = false;
            if(isset($data['translate_id'])){
                $this->resourceModel->load($model, $data['translate_id']);
                $flag = true;
            }
            $model->setData($data);
            try{
                $this->resourceModel->save($model);
                if($flag) {
                    $this->messageManager->addSuccessMessage(__('Translation updates saved.'));
                }
                else{
                    $this->messageManager->addSuccessMessage(__('New Translation created successfully.'));
                }
                return $redirect->setPath('*/*/');
            } catch (\Exception $e){
                $this->messageManager->addErrorMessage($e->getMessage());
                $redirect->setUrl($currentUrl);
            }
        }
        return $redirect->setPath('*/*/');
    }
}
