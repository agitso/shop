<?php
namespace Ag\Shop\Inventory\Service;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class InventoryItemService {

	/**
	 * @var \Ag\Shop\Inventory\Domain\Repository\InventoryItemRepository
	 * @Flow\Inject
	 */
	protected $itemRepository;

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	/**
	 * @return array
	 */
	public function getInventoryItemsForCatalog() {
		$items = $this->itemRepository->findAll()->toArray();
		foreach ($items as $key => $item) {
			$items[$key] = $item->getDescriptor();
		}

		return $items;
	}

	/**
	 * @param string $title
	 * @param string $price
	 * @param int $inStock
	 * @return \Ag\Shop\Inventory\Domain\Model\InventoryItemDescriptor
	 */
	public function createInventoryItem($title, $price, $inStock) {
		$item = new \Ag\Shop\Inventory\Domain\Model\InventoryItem($title, $price, $inStock);

		$this->itemRepository->add($item);
		$this->persistenceManager->persistAll();

		return $item->getDescriptor();
	}
}
?>