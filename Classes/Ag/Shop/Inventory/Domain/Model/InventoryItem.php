<?php
namespace Ag\Shop\Inventory\Domain\Model;

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class InventoryItem {

	/**
	 * @var \Ag\Event\Service\EventService
	 * @Flow\Inject
	 */
	protected $eventService;

	/**
	 * @var int
	 * @ORM\Version
	 */
	protected $version = 0;

	/**
	 * @var string
	 * @ORM\Id
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
	 * @param string $title
	 * @param float $price
	 * @param int $inStock
	 */
	public function __construct($title, $price, $inStock) {
		$this->sku = \TYPO3\Flow\Utility\Algorithms::generateUUID();
		$this->setTitle($title);
		$this->setPrice($price);
		$this->setInStock($inStock);
	}

	/**
	 * @param string $title
	 * @throws \InvalidArgumentException
	 */
	protected function setTitle($title) {
		$title = trim($title);
		if (empty($title)) {
			throw new \InvalidArgumentException('Title required.');
		}
		$this->title = $title;
	}

	/**
	 * @param float $price
	 * @throws \InvalidArgumentException
	 */
	protected function setPrice($price) {
		$price = floatval($price);
		if ($price < 0) {
			throw new \InvalidArgumentException('Price must be greater than or equal to 0.');
		}

		$this->price = $price;
	}

	/**
	 * @param int $inStock
	 * @throws \InvalidArgumentException
	 */
	protected function setInStock($inStock) {
		$inStock = intval($inStock);

		if ($inStock < 0) {
			throw new \InvalidArgumentException('In stock must be greater than or equal to 0.');
		}

		$this->inStock = $inStock;
	}

	/**
	 * @return InventoryItemDescriptor
	 */
	public function getDescriptor() {

		$d = new InventoryItemDescriptor();
		$d->price = $this->price;
		$d->title = $this->title;
		$d->inStock = $this->inStock;
		$d->sku = $this->sku;

		return $d;
	}

	/**
	 * @param int $quantity
	 */
	public function removeFromStock($quantity) {
		if ($this->inStock > 0 && ($this->inStock - $quantity) <= 0) {
			$this->eventService->publish(new \Ag\Shop\Inventory\Domain\Event\InventoryItemOutOfStockEvent($this->sku));
		}

		$this->inStock -= $quantity;
	}

}

?>