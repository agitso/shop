<?php
namespace Ag\Shop\Controller;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class ShopController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @var \Ag\Shop\Inventory\Service\InventoryItemService
	 * @Flow\Inject
	 */
	protected $inventoryItemService;

	/**
	 * @var \Ag\Shop\Billing\Service\OrderService
	 * @Flow\Inject
	 */
	protected $orderService;

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('products', $this->inventoryItemService->getInventoryItemsForCatalog());
	}

	/**
	 * @param string $sku
	 */
	public function showAction($sku){
		$product = $this->inventoryItemService->getInventoryItem($sku);

		if(empty($product)) {
			$this->redirect('index');
		}

		$this->view->assign('product', $product);
	}

	/**
	 * @param string $title
	 * @param float $price
	 * @param int $inStock
	 */
	public function newAction($title, $price, $inStock) {
		$this->inventoryItemService->createInventoryItem($title, $price, $inStock);
		$this->redirect('index');
	}

	/**
	 * @param string $customer
	 * @param string $sku
	 * @param int $quantity
	 * @return void
	 */
	public function placeOrderAction($customer, $sku, $quantity) {
		$order = $this->orderService->placeOrder($customer, $sku, $quantity);

		$this->view->assign('order', $order);
	}

	/**
	 * @param int $orderId
	 */
	public function completeOrderAction($orderId) {
		$this->orderService->completeOrder($orderId);

		$this->addFlashMessage('Thanks for your order. You will receive an receipt with email.');

		$this->redirect('index');
	}


}

?>