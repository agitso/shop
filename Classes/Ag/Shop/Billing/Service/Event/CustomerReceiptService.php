<?php
namespace Ag\Shop\Billing\Service\Event;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class CustomerReceiptService {

	/**
	 * @var \Ag\Shop\Billing\Domain\Repository\OrderRepository
	 * @Flow\Inject
	 */
	protected $orderRepository;

	/**
	 * @var \Ag\Email\Service\EmailService
	 * @Flow\Inject
	 */
	protected $emailService;

	/**
	 * @param \Ag\Shop\Inventory\Domain\Event\OrderCompletedEvent $event
	 */
	public function onOrderCompletedSendReceiptToCustomer($event) {
		$order = $this->orderRepository->findByIdentifier($event->getOrderId());
		$orderDescriptor = $order->getDescriptor();

		$this->emailService->send(
			$orderDescriptor->getCustomer(),
			'customer@domain.tld',
			'Receipt for order #'.$orderDescriptor->getOrderId(),
			'This is your receipt with order id #'.$orderDescriptor->getOrderId()
		);
	}
}
?>