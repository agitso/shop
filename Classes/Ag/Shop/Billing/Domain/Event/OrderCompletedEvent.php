<?php
namespace Ag\Shop\Billing\Domain\Event;

class OrderCompletedEvent extends \Ag\Event\Domain\Model\DomainEvent {

	/**
	 * @var int
	 */
	protected $orderId;

	/**
	 * @param int $orderId
	 */
	public function __construct($orderId) {
		parent::__construct();
		$this->orderId = $orderId;
	}

	/**
	 * @return int
	 */
	public function getOrderId() {
		return $this->orderId;
	}
}

?>