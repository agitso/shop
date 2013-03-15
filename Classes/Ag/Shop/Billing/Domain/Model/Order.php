<?php
namespace Ag\Shop\Billing\Domain\Model;

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Order {

	/**
	 * @var int
	 * @ORM\Version
	 */
	protected $version = 0;

	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 */
	protected $orderId;

	/**
	 * @var string
	 */
	protected $customer;

	/**
	 * @var string
	 */
	protected $sku;

	/**
	 * @var int
	 */
	protected $quantity;

	/**
	 * @var bool
	 */
	protected $completed;

	/**
	 * @param string $customer
	 * @param string $sku
	 * @param int $quantity
	 */
	public function __construct($customer, $sku, $quantity) {
		$this->setCustomer($customer);
		$this->setInventoryItem($sku, $quantity);
		$this->completed = FALSE;
		$this->customerBilled = FALSE;
	}

	/**
	 * @param string $customer
	 * @throws \InvalidArgumentException
	 */
	protected function setCustomer($customer) {
		$customer = trim($customer);

		if (empty($customer)) {
			throw new \InvalidArgumentException('Customer must be provided.');
		}

		$this->customer = $customer;
	}

	/**
	 * @param string $sku
	 * @param int $quantity
	 * @throws \InvalidArgumentException
	 */
	protected function setInventoryItem($sku, $quantity) {
		$sku = trim($sku);
		$quantity = intval($quantity);

		if (empty($sku)) {
			throw new \InvalidArgumentException('SKU is required.');
		}

		if ($quantity <= 0) {
			throw new \InvalidArgumentException('Quantity must be positive.');
		}

		$this->sku = $sku;
		$this->quantity = $quantity;
	}

	/**
	 * @param \Ag\Event\Service\EventService $eventService
	 * @return void
	 */
	public function complete($eventService) {
		if ($this->isCompleted()) {
			return;
		}

		$this->completed = TRUE;

		$eventService->publish(new \Ag\Shop\Billing\Domain\Event\OrderCompletedEvent($this->orderId));
	}

	/**
	 * @return bool
	 */
	protected function isCompleted() {
		return $this->completed;
	}

	/**
	 * @return \Ag\Shop\Billing\Domain\Model\OrderDescriptor
	 */
	public function getDescriptor() {
		$d = new OrderDescriptor();
		$d->orderId = $this->orderId;
		$d->customer = $this->customer;
		$d->sku = $this->sku;
		$d->quantity = $this->quantity;
		$d->completed = $this->completed;

		return $d;
	}


}

?>