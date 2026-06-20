<?php
declare(strict_types=1);

namespace Elsherif\RequestLogger\Observer;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

/**
 * Dispatcher for the `controller_action_predispatch` event.
 */
class LogRequestObserver implements ObserverInterface
{
    private LoggerInterface $logger;
    private Http $http;
    public function __construct(
        LoggerInterface $logger,
        Http $http

    ){
        $this->logger = $logger;
        $this->http = $http;
    }
    /**
     * Handle the `controller_action_predispatch` event.
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer): void
    {
        // TODO: Not yet implemented
        try {
            /**
             * @var \Magento\Framework\App\Request\Http $request;
             */
            $request = $observer->getEvent()->getData('request');
//            dd($request);
            $this->logger->info('get information from req' , [
                'utl' => $request->getRequestUri(),
                    'method' => $request->getMethod()
                ]);

        } catch (\Exception $e){
            $this->logger->critical($e->getMessage());

        }

    }
}
