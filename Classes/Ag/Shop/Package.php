<?php
namespace Ag\Shop;

use \TYPO3\Flow\Package\Package as BasePackage;

class Package extends BasePackage {

	/**
	 * @param \TYPO3\Flow\Core\Bootstrap $bootstrap The current bootstrap
	 * @return void
	 */
	public function boot(\TYPO3\Flow\Core\Bootstrap $bootstrap) {
		$dispatcher = $bootstrap->getSignalSlotDispatcher();

		\Ag\Event\EventRegister::listenFor(
			$dispatcher,
			'Ag\Shop\Inventory\Domain\Event\InventoryItemOutOfStockEvent',
			'Ag\Shop\Inventory\Service\Event\SupplyNotificationService', 'onInventoryItemOutOfStockSendMailToSupplyManager'
		);

		\Ag\Event\EventRegister::listenFor(
			$dispatcher,
			'Ag\Shop\Billing\Domain\Event\OrderCompletedEvent',
			'Ag\Shop\Inventory\Service\Event\StockUpdaterService', 'onOrderCompletedRemoveQuantityFromStock'
		);

		\Ag\Event\EventRegister::listenFor(
			$dispatcher,
			'Ag\Shop\Billing\Domain\Event\OrderCompletedEvent',
			'Ag\Shop\Billing\Service\Event\CustomerReceiptService', 'onOrderCompletedSendReceiptToCustomer'
		);
	}
}

?>