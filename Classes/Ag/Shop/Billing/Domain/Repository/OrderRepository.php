<?php
namespace Ag\Shop\Billing\Domain\Repository;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class OrderRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	 * @param int $orderId
	 * @return \Ag\Shop\Billing\Domain\Model\Order
	 */
	public function findByIdentifier($orderId) {
		return parent::findByIdentifier($orderId);
	}
}
?>