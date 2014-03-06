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
 * Test case for class Wewo\Wewoshop\Controller\DeliveryAddressController.
 *
 */
class DeliveryAddressControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Wewo\Wewoshop\Controller\DeliveryAddressController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Wewo\\Wewoshop\\Controller\\DeliveryAddressController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function listActionFetchesAllDeliveryAddressesFromRepositoryAndAssignsThemToView() {

		$allDeliveryAddresses = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$deliveryAddressRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\DeliveryAddressRepository', array('findAll'), array(), '', FALSE);
		$deliveryAddressRepository->expects($this->once())->method('findAll')->will($this->returnValue($allDeliveryAddresses));
		$this->inject($this->subject, 'deliveryAddressRepository', $deliveryAddressRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('deliveryAddresses', $allDeliveryAddresses);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenDeliveryAddressToView() {
		$deliveryAddress = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('deliveryAddress', $deliveryAddress);

		$this->subject->showAction($deliveryAddress);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenDeliveryAddressToView() {
		$deliveryAddress = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newDeliveryAddress', $deliveryAddress);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($deliveryAddress);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenDeliveryAddressToDeliveryAddressRepository() {
		$deliveryAddress = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();

		$deliveryAddressRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\DeliveryAddressRepository', array('add'), array(), '', FALSE);
		$deliveryAddressRepository->expects($this->once())->method('add')->with($deliveryAddress);
		$this->inject($this->subject, 'deliveryAddressRepository', $deliveryAddressRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($deliveryAddress);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$deliveryAddress = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();

		$deliveryAddressRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\DeliveryAddressRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'deliveryAddressRepository', $deliveryAddressRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($deliveryAddress);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$deliveryAddress = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();

		$deliveryAddressRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\DeliveryAddressRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'deliveryAddressRepository', $deliveryAddressRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($deliveryAddress);
	}
}
