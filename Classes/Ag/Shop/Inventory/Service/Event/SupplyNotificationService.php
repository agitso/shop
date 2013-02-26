<?php
namespace Ag\Shop\Inventory\Service\Event;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class SupplyNotificationService {

	/**
	 * @var \Ag\Email\Service\EmailService
	 * @Flow\Inject
	 */
	protected $emailService;

	/**
	 * @param \Ag\Shop\Inventory\Domain\Event\InventoryItemOutOfStockEvent $event
	 */
	public function onInventoryItemOutOfStockSendMailToSupplyManager($event) {
		$this->emailService->send(
			'Supply Manager',
			'supply@domain.tld',
			'Product with SKU ' . $event->getSku(). ' just went out of stock.',
			'Dear supply manager.'.chr(10).'Product with SKU ' . $event->getSku(). ' just went out of stock.'
		);
	}
}
?>