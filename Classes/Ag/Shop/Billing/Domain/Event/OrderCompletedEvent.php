<?php
namespace Ag\Shop\Billing\Domain\Event;

class OrderCompletedEvent extends \Ag\Event\Domain\Model\DomainEvent {

	/**
	 * @var int
	 */
	public $orderId;

	/**
	 * @param int $orderId
	 */
	public function __construct($orderId) {
		parent::__construct();
		$this->orderId = $orderId;
	}
}

?>