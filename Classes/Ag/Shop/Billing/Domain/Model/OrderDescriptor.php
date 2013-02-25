<?php
namespace Ag\Shop\Billing\Domain\Model;

class OrderDescriptor {

	/**
	 * @var int
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
	 * @param int $orderId
	 * @param string $customer
	 * @param string $sku
	 * @param int $quantity
	 * @param bool $completed
	 */
	public function __construct($orderId, $customer, $sku, $quantity, $completed) {
		$this->orderId = $orderId;
		$this->customer = $customer;
		$this->sku = $sku;
		$this->quantity = $quantity;
		$this->completed = $completed;
	}

	/**
	 * @return boolean
	 */
	public function getCompleted() {
		return $this->completed;
	}

	/**
	 * @return string
	 */
	public function getCustomer() {
		return $this->customer;
	}

	/**
	 * @return int
	 */
	public function getOrderId() {
		return $this->orderId;
	}

	/**
	 * @return int
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @return string
	 */
	public function getSku() {
		return $this->sku;
	}


}

?>