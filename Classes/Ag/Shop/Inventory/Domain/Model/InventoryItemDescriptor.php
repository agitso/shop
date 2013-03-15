<?php
namespace Ag\Shop\Inventory\Domain\Model;

class InventoryItemDescriptor {

	/**
	 * @var string
	 */
	public $sku;

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var float
	 */
	public $price;

	/**
	 * @var int
	 */
	public $inStock;

}

?>