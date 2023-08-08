<?php

namespace MantraMakers\OmniTranslate\Controller\Adminhtml\Index;


use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use MantraMakers\OmniTranslate\Model\ResourceModel\TranslateModel\CollectionFactory;

/**
 * Class MassDelete
 * @package MantraMakers\OmniTranslate\Controller\Adminhtml\Index
 */
class MassDelete extends Action
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var ResultFactory
     */

    protected $resultFactory;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param ResultFactory $resultFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        ResultFactory $resultFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    /**
     * Execute action.
     *
     * @return Redirect
     *
     * @throws LocalizedException|Exception
     */
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $done = 0;
            foreach ($collection as $item) {
                $item->delete();
                ++$done;
            }
            if ($done) {
                $this->messageManager->addSuccessMessage(__('A total of %1 record(s) were modified.', $done));
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $redirect->setPath('*/*/');
    }

}
