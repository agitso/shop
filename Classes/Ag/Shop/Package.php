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

		$dispatcher->connect(
			'Ag\Event\Service\EventService', 'ag_shop_inventory',
			'Ag\Shop\Inventory\Service\Event\EventService', 'listen'
		);

		$dispatcher->connect(
			'Ag\Event\Service\EventService', 'ag_shop_billing',
			'Ag\Shop\Billing\Service\Event\EventService', 'listen'
		);
	}
}

?>