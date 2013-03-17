<?php
namespace Ag\Shop\Cache\EventHandler\Ag\Shop\Billing;

use TYPO3\Flow\Annotations as Flow;
use \TYPO3\Flow\Configuration\ConfigurationManager as ConfigurationManager;

/**
 * @Flow\Scope("singleton")
 */
class OrderCompletedEventHandler {

	/**
	 * @var \Ag\Cache\Service\BanService
	 * @Flow\Inject
	 */
	protected $banService;

	/**
	 * @var \Ag\Shop\Billing\Service\OrderService
	 * @Flow\Inject
	 */
	protected $orderService;

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
	 * @param \Ag\Shop\Billing\Domain\Event\OrderCompletedEvent $event
	 * @return void
	 */
	public function handle(\Ag\Shop\Billing\Domain\Event\OrderCompletedEvent $event) {
		$order = $this->orderService->getOrder($event->orderId);

		$this->banService->ban($this->uriBuilder->uriFor('index', array(), 'Shop', 'Ag.Shop', NULL));
		$this->banService->ban($this->uriBuilder->uriFor('show', array('sku'=>$order->sku), 'Shop', 'Ag.Shop', NULL));

	}
}

?>