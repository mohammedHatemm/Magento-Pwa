<?php

namespace Elsherif\ActiveModule\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Module\FullModuleList;
use Magento\Framework\Module\ModuleListInterface;
use Psr\Log\LoggerInterface;

class Index implements HttpGetActionInterface
{

    private ModuleListInterface $moduleList;
    private JsonFactory $jsonFactory;
    private FullModuleList $fullModuleList;
    private LoggerInterface $logger;

    public function __construct(
        ModuleListInterface $moduleList,
        JsonFactory $jsonFactory,
        LoggerInterface $logger,
        FullModuleList $fullModuleList
    ){
        $this->moduleList = $moduleList;
        $this->jsonFactory = $jsonFactory;
        $this->logger = $logger;
        $this->fullModuleList = $fullModuleList;
    }
    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        // TODO: Implement execute method.

        try {
            $allModules = $this->fullModuleList->getNames();
            $allActiveModule = $this->moduleList->getNames();
            $disActiveModule = array_diff($allModules, $allActiveModule);
            $this->logger->info('get modules ',[
                'allModules' => $allModules,
                'disActiveModule' => $disActiveModule,
                'active modules' => $allActiveModule
            ]);
            $result = $this->jsonFactory->create();
            return $result->setData([
                'all Modules' => $allModules,
            'active Modules' => $disActiveModule,
            'disactive Modules' => $disActiveModule
            ]);




        }catch (\Exception $e){
            $this->logger->critical($e->getMessage());


        }

    }
}
