<?php
namespace Ag\Shop\Inventory\EventHandler\Ag\Shop\Billing;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class OrderCompletedEventHandler {

	/**
	 * @var \Ag\Shop\Inventory\Domain\Repository\InventoryItemRepository
	 * @Flow\Inject
	 */
	protected $itemRepository;

	/**
	 * @var \Ag\Shop\Billing\Service\OrderService
	 * @Flow\Inject
	 */
	protected $orderService;

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	/**
	 * @var \TYPO3\Flow\Log\SystemLoggerInterface
	 * @Flow\Inject
	 */
	protected $systemLogger;

	/**
	 * @param \Ag\Shop\Billing\Domain\Event\OrderCompletedEvent $event
	 * @return void
	 */
	public function handle(\Ag\Shop\Billing\Domain\Event\OrderCompletedEvent $event) {
		$order = $this->orderService->getOrder($event->getOrderId());

		$completed = FALSE;
		for ($i = 0; $i < 10 && !$completed; $i++) {
			try {
				$item = $this->itemRepository->findByIdentifier($order->getSku());

				$item->removeFromStock($order->getQuantity());

				$this->itemRepository->update($item);
				$this->persistenceManager->persistAll();

				$completed = TRUE;

			} catch (\Doctrine\ORM\OptimisticLockException $e) {
				sleep(1);
			}
		}

		if (!$completed) {
			$this->systemLogger->log('Could not successfully update inventory stock from order ' . $order->getOrderId(), LOG_CRIT);
		}
	}
}

?>