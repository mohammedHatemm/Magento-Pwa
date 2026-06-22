<?php

namespace Elsherif\VersionInfo\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Psr\Log\LoggerInterface;

class Index implements HttpGetActionInterface
{
    private ProductMetadataInterface $productMetadata;
    private JsonFactory $jsonFactory;
    private LoggerInterface $logger;
    public function __construct(
        ProductMetadataInterface $productMetadata,
        JsonFactory $jsonFactory,
        LoggerInterface $logger
    ){
        $this->productMetadata = $productMetadata;
        $this->jsonFactory = $jsonFactory;
        $this->logger = $logger;
    }
    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {

        try{
            $version = $this->productMetadata->getVersion();
            $name = $this->productMetadata->getName();
            $edition = $this->productMetadata->getEdition();
            $this->logger->info('the data is ', [
                'version' => $version,
            'name' => $name,
            'edition' => $edition
            ]);
            $result= $this->jsonFactory->create();
            return $result->setData([
                'version' => $version,
                'name' => $name,
                'edition' => $edition,
                'php_version' => PHP_VERSION
            ]);


        }catch (\Exception $e){
           return $this->jsonFactory->create()->setData(['error' => $e->getMessage()]);
        }
    }
}
