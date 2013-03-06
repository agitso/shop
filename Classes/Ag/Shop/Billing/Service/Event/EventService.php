<?php
namespace Ag\Shop\Billing\Service\Event;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class EventService {

	/**
	 * @var \Ag\Shop\Billing\Service\Event\CustomerReceiptService
	 * @Flow\Inject
	 */
	protected $customerReceiptService;

	/**
	 * @param \Ag\Event\Domain\Model\DomainEvent $event
	 */
	public function listen($event) {
		if($event instanceof \Ag\Shop\Billing\Domain\Event\OrderCompletedEvent) {
			$this->customerReceiptService->onOrderCompletedSendReceiptToCustomer($event);
		}
	}

}
?>