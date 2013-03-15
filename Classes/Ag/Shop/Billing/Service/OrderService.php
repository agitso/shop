<?php
namespace Ag\Shop\Billing\Service;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class OrderService {

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
	 * @var \Ag\Event\Service\EventService
	 * @Flow\Inject
	 */
	protected $eventService;

	/**
	 * @param int $orderId
	 * @return \Ag\Shop\Billing\Domain\Model\OrderDescriptor|null
	 */
	public function getOrder($orderId) {
		$order = $this->orderRepository->findByIdentifier($orderId);

		if(empty($order)) {
			return NULL;
		}

		return $order->getDescriptor();
	}

	/**
	 * @param string $customer
	 * @param string $sku
	 * @param int $quantity
	 * @return \Ag\Shop\Billing\Domain\Model\OrderDescriptor
	 */
	public function placeOrder($customer, $sku, $quantity) {
		$order = new \Ag\Shop\Billing\Domain\Model\Order($customer, $sku, $quantity);

		$this->orderRepository->add($order);
		$this->persistenceManager->persistAll();

		return $order->getDescriptor();
	}

	/**
	 * @param int $orderId
	 * @throws \InvalidArgumentException
	 * @return \Ag\Shop\Billing\Domain\Model\OrderDescriptor
	 */
	public function completeOrder($orderId) {
		$order = $this->orderRepository->findByIdentifier($orderId);

		if(empty($order)) {
			throw new \InvalidArgumentException('No order found.');
		}

		$order->complete($this->eventService);

		$this->orderRepository->update($order);
		$this->persistenceManager->persistAll();

		return $order->getDescriptor();
	}

}

?>