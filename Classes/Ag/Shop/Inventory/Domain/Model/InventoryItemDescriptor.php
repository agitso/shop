<?php
namespace Ag\Shop\Inventory\Domain\Model;

class InventoryItemDescriptor {

	/**
	 * @var string
	 */
	protected $sku;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var float
	 */
	protected $price;

	/**
	 * @var int
	 */
	protected $inStock;

	/**
	 * @param string $sku
	 * @param string $title
	 * @param float $price
	 * @param int $inStock
	 */
	public function __construct($sku, $title, $price, $inStock) {
		$this->sku = $sku;
		$this->title = $title;
		$this->price = $price;
		$this->inStock = $inStock;
	}

	/**
	 * @return float
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @return string
	 */
	public function getSku() {
		return $this->sku;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return int
	 */
	public function getInStock() {
		return $this->inStock;
	}
}

?>