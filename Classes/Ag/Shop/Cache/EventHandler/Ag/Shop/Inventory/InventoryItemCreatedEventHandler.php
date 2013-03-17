<?php
namespace Ag\Shop\Cache\EventHandler\Ag\Shop\Inventory;

use TYPO3\Flow\Annotations as Flow;
use \TYPO3\Flow\Configuration\ConfigurationManager as ConfigurationManager;

/**
 * @Flow\Scope("singleton")
 */
class InventoryItemCreatedEventHandler {

	/**
	 * @var \Ag\Cache\Service\BanService
	 * @Flow\Inject
	 */
	protected $banService;

	/**
	 * @var \TYPO3\Flow\Mvc\Routing\UriBuilder
	 */
	protected $uriBuilder;

	/**
	 * @param \TYPO3\Flow\Configuration\ConfigurationManager $configurationManager
	 */
	public function injectUriBuilder(\TYPO3\Flow\Configuration\ConfigurationManager $configurationManager) {
		$flowSettings = $configurationManager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'TYPO3.Flow');
		$httpRequest = \TYPO3\Flow\Http\Request::create(new \TYPO3\Flow\Http\Uri('http://localhost'));
		$httpRequest->injectSettings($flowSettings);
		$request = new \TYPO3\Flow\Mvc\ActionRequest($httpRequest);

		$uriBuilder = new \TYPO3\Flow\Mvc\Routing\UriBuilder();
		$uriBuilder->setRequest($request);
		$uriBuilder->setCreateAbsoluteUri(TRUE);

		$this->uriBuilder = $uriBuilder;
	}


	/**
	 * @param \Ag\Shop\Inventory\Domain\Event\InventoryItemCreatedEvent $event
	 */
	public function handle(\Ag\Shop\Inventory\Domain\Event\InventoryItemCreatedEvent $event) {
		$this->banService->ban($this->uriBuilder->uriFor('index', array(), 'Shop', 'Ag.Shop', NULL));
	}
}
?>