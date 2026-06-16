<?php

namespace Elsherif\StoreInfo\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Store\Model\StoreManagerInterface;

class StoreInfo implements ResolverInterface
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param StoreManagerInterface $storeManager
     */

    public function __construct(
        StoreManagerInterface $storeManager

    ){
        $this->storeManager = $storeManager;
    }

    /**
     * @param Field $field
     * @param $context
     * @param ResolveInfo $
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo,
        array $value = null,
        array $args = null
    ){
        $store = $this->storeManager->getStore();
        return [
            'store_name' => $store->getName(),
            'store_phone'=>$store->getConfig('general/store_information/phone'),
            'store_email'=>$store->getConfig('general/store_information/email'),
            'store_address'=>$store->getConfig('general/store_information/address'),

        ];
    }

}
