<?php
namespace Ag\Shop\Inventory\EventHandler\Ag\Shop\Inventory;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class InventoryItemOutOfStockEventHandler {

	/**
	 * @var \Ag\Email\Service\EmailService
	 * @Flow\Inject
	 */
	protected $emailService;

	/**
	 * @param \Ag\Shop\Inventory\Domain\Event\InventoryItemOutOfStockEvent $event
	 */
	public function handle(\Ag\Shop\Inventory\Domain\Event\InventoryItemOutOfStockEvent $event) {
		$this->emailService->send(
			'Supply Manager',
			'supply@domain.tld',
				'Product with SKU ' . $event->sku . ' just went out of stock.',
				'Dear supply manager.' . chr(10) . 'Product with SKU ' . $event->sku . ' just went out of stock.'
		);
	}
}

?>