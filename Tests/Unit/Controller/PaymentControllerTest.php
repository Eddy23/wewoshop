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
 * Test case for class Wewo\Wewoshop\Controller\PaymentController.
 *
 */
class PaymentControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Wewo\Wewoshop\Controller\PaymentController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Wewo\\Wewoshop\\Controller\\PaymentController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function listActionFetchesAllPaymentsFromRepositoryAndAssignsThemToView() {

		$allPayments = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('findAll'), array(), '', FALSE);
		$paymentRepository->expects($this->once())->method('findAll')->will($this->returnValue($allPayments));
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('payments', $allPayments);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenPaymentToView() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('payment', $payment);

		$this->subject->showAction($payment);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenPaymentToView() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newPayment', $payment);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($payment);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenPaymentToPaymentRepository() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('add'), array(), '', FALSE);
		$paymentRepository->expects($this->once())->method('add')->with($payment);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($payment);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($payment);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($payment);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenPaymentToView() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('payment', $payment);

		$this->subject->editAction($payment);
	}


	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenPaymentInPaymentRepository() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('update'), array(), '', FALSE);
		$paymentRepository->expects($this->once())->method('update')->with($payment);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($payment);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($payment);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($payment);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenPaymentFromPaymentRepository() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('remove'), array(), '', FALSE);
		$paymentRepository->expects($this->once())->method('remove')->with($payment);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($payment);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($payment);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($payment);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenPaymentToPaymentRepository() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('add'), array(), '', FALSE);
		$paymentRepository->expects($this->once())->method('add')->with($payment);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($payment);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($payment);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$payment = new \Wewo\Wewoshop\Domain\Model\Payment();

		$paymentRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\PaymentRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'paymentRepository', $paymentRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($payment);
	}
}
