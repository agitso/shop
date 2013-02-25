<?php
namespace Ag\Shop\Billing\Service;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class EventSubscriberService {

	/**
	 * @var \Ag\Shop\Billing\Domain\Repository\OrderRepository
	 * @Flow\Inject
	 */
	protected $orderRepository;

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
	 * @param \Ag\Shop\Inventory\Domain\Event\OrderCompletedEvent $event
	 */
	public function onOrderCompletedSendEmailToCustomer($event) {
		$order = $this->orderRepository->findByIdentifier($event->getOrderId());

		$this->sendReceiptToCustomer($order->getDescriptor());
	}

	/**
	 * @param \Ag\Shop\Billing\Domain\Model\OrderDescriptor $orderDesriptor
	 */
	protected function sendReceiptToCustomer($orderDesriptor) {
		// For now just log this
		$this->systemLogger->log('Dear ' . $orderDesriptor->getCustomer() . '. This is your receipt with order id #'.$orderDesriptor->getOrderId());
	}

}
?>