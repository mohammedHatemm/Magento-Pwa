<?php

namespace Elsherif\AreaDetection\Observer;

use Magento\Framework\App\State;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

/**
 * Observes the `cms_page_save_after` event.
 */
class DetectAreaObserver implements ObserverInterface
{
    private State $state;
    private LoggerInterface $logger;
    public function __construct(
        State $state,
        LoggerInterface $logger

    )
    {
        $this->state = $state;
        $this->logger = $logger;
    }
    /**
     *
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer) :void
    {
        try{
            $areaCode = $this->state->getAreaCode();
            $this->logger->info("Detect Area Code: $areaCode");
        }catch (\Exception $e){
            $this->logger->error( 'Could not catch the area '.$e->getMessage());
        }


    }
}
