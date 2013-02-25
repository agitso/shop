<?php
namespace Ag\Shop\Inventory\Domain\Event;

class InventoryItemOutOfStockEvent extends \Ag\Event\Domain\Model\DomainEvent {

	/**
	 * @var string
	 */
	protected $sku;

	/**
	 * @param string $sku
	 */
	public function __construct($sku) {
		parent::__construct();
		$this->sku = $sku;
	}

	/**
	 * @return string
	 */
	public function getSku() {
		return $this->sku;
	}


}
?>