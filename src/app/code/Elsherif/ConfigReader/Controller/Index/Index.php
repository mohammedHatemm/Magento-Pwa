<?php

namespace Elsherif\ConfigReader\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Store\Model\ScopeInterface;

class Index implements HttpGetActionInterface
{
    private ScopeConfigInterface $scopeConfig;
    private JsonFactory $jsonFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        JsonFactory $jsonFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        $storeName = $this->scopeConfig->getValue(
            'general/store_information/name',
            ScopeInterface::SCOPE_STORE
        );

        $locale = $this->scopeConfig->getValue(
            'general/locale/code',
            ScopeInterface::SCOPE_STORE
        );

        $timezone = $this->scopeConfig->getValue(
            'general/locale/timezone',
            ScopeInterface::SCOPE_STORE
        );

        $country = $this->scopeConfig->getValue(
            'general/store_information/country_id',
            ScopeInterface::SCOPE_STORE
        );

        return $this->jsonFactory->create()->setData([
            'store_name' => $storeName,
            'locale' => $locale,
            'timezone' => $timezone,
            'country' => $country
        ]);
    }
}
