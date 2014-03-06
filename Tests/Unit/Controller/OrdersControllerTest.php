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
 * Test case for class Wewo\Wewoshop\Controller\OrdersController.
 *
 */
class OrdersControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Wewo\Wewoshop\Controller\OrdersController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Wewo\\Wewoshop\\Controller\\OrdersController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function listActionFetchesAllOrderssFromRepositoryAndAssignsThemToView() {

		$allOrderss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('findAll'), array(), '', FALSE);
		$ordersRepository->expects($this->once())->method('findAll')->will($this->returnValue($allOrderss));
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('orderss', $allOrderss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenOrdersToView() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('orders', $orders);

		$this->subject->showAction($orders);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenOrdersToView() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newOrders', $orders);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($orders);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenOrdersToOrdersRepository() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('add'), array(), '', FALSE);
		$ordersRepository->expects($this->once())->method('add')->with($orders);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($orders);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($orders);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($orders);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenOrdersToView() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('orders', $orders);

		$this->subject->editAction($orders);
	}


	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenOrdersInOrdersRepository() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('update'), array(), '', FALSE);
		$ordersRepository->expects($this->once())->method('update')->with($orders);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($orders);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($orders);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($orders);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenOrdersFromOrdersRepository() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('remove'), array(), '', FALSE);
		$ordersRepository->expects($this->once())->method('remove')->with($orders);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($orders);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($orders);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$ordersRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\OrdersRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'ordersRepository', $ordersRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($orders);
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenOrdersToView() {
		$orders = new \Wewo\Wewoshop\Domain\Model\Orders();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('orders', $orders);

		$this->subject->showAction($orders);
	}
}
