<?php
namespace Ag\Shop\Inventory\Service\Event;
use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class EventService {

	/**
	 * @var \Ag\Shop\Inventory\Service\Event\StockUpdaterService
	 * @Flow\Inject
	 */
	protected $stockUpdaterService;

	/**
	 * @var \Ag\Shop\Inventory\Service\Event\SupplyNotificationService
	 * @Flow\Inject
	 */
	protected $supplyNotificationService;

	/**
	 * @param \Ag\Event\Domain\Model\DomainEvent $event
	 */
	public function listen($event) {

		if($event instanceof \Ag\Shop\Billing\Domain\Event\OrderCompletedEvent) {
			$this->stockUpdaterService->onOrderCompletedRemoveQuantityFromStock($event);
		}
		elseif($event instanceof \Ag\Shop\Inventory\Domain\Event\InventoryItemOutOfStockEvent) {
			$this->supplyNotificationService->onInventoryItemOutOfStockSendMailToSupplyManager($event);
		}

	}
}
?>