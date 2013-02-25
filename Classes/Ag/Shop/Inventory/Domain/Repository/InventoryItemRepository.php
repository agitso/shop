<?php
namespace Ag\Shop\Inventory\Domain\Repository;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class InventoryItemRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	 * @param string $sku
	 * @return \Ag\Shop\Inventory\Domain\Model\InventoryItem
	 */
	public function findByIdentifier($sku) {
		return parent::findByIdentifier($sku);
	}

}
?>