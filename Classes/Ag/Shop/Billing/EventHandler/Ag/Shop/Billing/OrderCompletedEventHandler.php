<?php
namespace Ag\Shop\Billing\EventHandler\Ag\Shop\Billing;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class OrderCompletedEventHandler {

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
	 * @param \Ag\Shop\Billing\Domain\Event\OrderCompletedEvent $event
	 * @return void
	 */
	public function handle(\Ag\Shop\Billing\Domain\Event\OrderCompletedEvent $event) {
		$order = $this->orderRepository->findByIdentifier($event->orderId);
		$orderDescriptor = $order->getDescriptor();

		$this->emailService->send(
			$orderDescriptor->customer,
			'customer@domain.tld',
				'Receipt for order #' . $orderDescriptor->orderId,
				'This is your receipt with order id #' . $orderDescriptor->orderId
		);
	}
}

?>