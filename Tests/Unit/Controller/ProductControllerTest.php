<?php
namespace Wewo\Wewoshop\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class Wewo\Wewoshop\Controller\ProductController.
 *
 */
class ProductControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Wewo\Wewoshop\Controller\ProductController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Wewo\\Wewoshop\\Controller\\ProductController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function listActionFetchesAllProductsFromRepositoryAndAssignsThemToView() {

		$allProducts = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('findAll'), array(), '', FALSE);
		$productRepository->expects($this->once())->method('findAll')->will($this->returnValue($allProducts));
		$this->inject($this->subject, 'productRepository', $productRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('products', $allProducts);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenProductToView() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('product', $product);

		$this->subject->showAction($product);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenProductToView() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newProduct', $product);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($product);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenProductToProductRepository() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('add'), array(), '', FALSE);
		$productRepository->expects($this->once())->method('add')->with($product);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($product);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($product);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($product);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenProductToView() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('product', $product);

		$this->subject->editAction($product);
	}


	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenProductInProductRepository() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('update'), array(), '', FALSE);
		$productRepository->expects($this->once())->method('update')->with($product);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($product);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($product);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($product);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenProductFromProductRepository() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$productRepository->expects($this->once())->method('remove')->with($product);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($product);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($product);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($product);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllProductsFromRepositoryAndAssignsThemToView() {

		$allProducts = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('findAll'), array(), '', FALSE);
		$productRepository->expects($this->once())->method('findAll')->will($this->returnValue($allProducts));
		$this->inject($this->subject, 'productRepository', $productRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('products', $allProducts);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenProductFromProductRepository() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$productRepository->expects($this->once())->method('remove')->with($product);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($product);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($product);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($product);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenProductFromProductRepository() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$productRepository->expects($this->once())->method('remove')->with($product);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($product);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($product);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$product = new \Wewo\Wewoshop\Domain\Model\Product();

		$productRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\ProductRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'productRepository', $productRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($product);
	}
}
