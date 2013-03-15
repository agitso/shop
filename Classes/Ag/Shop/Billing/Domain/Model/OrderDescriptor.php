<?php
namespace Ag\Shop\Billing\Domain\Model;

class OrderDescriptor {

	/**
	 * @var int
	 */
	public $orderId;

	/**
	 * @var string
	 */
	public $customer;

	/**
	 * @var string
	 */
	public $sku;

	/**
	 * @var int
	 */
	public $quantity;

	/**
	 * @var bool
	 */
	public $completed;

}

?>