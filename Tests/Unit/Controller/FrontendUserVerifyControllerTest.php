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
 * Test case for class Wewo\Wewoshop\Controller\FrontendUserVerifyController.
 *
 */
class FrontendUserVerifyControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Wewo\Wewoshop\Controller\FrontendUserVerifyController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Wewo\\Wewoshop\\Controller\\FrontendUserVerifyController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function listActionFetchesAllFrontendUserVerifiesFromRepositoryAndAssignsThemToView() {

		$allFrontendUserVerifies = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('findAll'), array(), '', FALSE);
		$frontendUserVerifyRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFrontendUserVerifies));
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('frontendUserVerifies', $allFrontendUserVerifies);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFrontendUserVerifyToView() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('frontendUserVerify', $frontendUserVerify);

		$this->subject->showAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenFrontendUserVerifyToView() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newFrontendUserVerify', $frontendUserVerify);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFrontendUserVerifyToFrontendUserVerifyRepository() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('add'), array(), '', FALSE);
		$frontendUserVerifyRepository->expects($this->once())->method('add')->with($frontendUserVerify);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFrontendUserVerifyToView() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('frontendUserVerify', $frontendUserVerify);

		$this->subject->editAction($frontendUserVerify);
	}


	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFrontendUserVerifyInFrontendUserVerifyRepository() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('update'), array(), '', FALSE);
		$frontendUserVerifyRepository->expects($this->once())->method('update')->with($frontendUserVerify);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenFrontendUserVerifyFromFrontendUserVerifyRepository() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('remove'), array(), '', FALSE);
		$frontendUserVerifyRepository->expects($this->once())->method('remove')->with($frontendUserVerify);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$frontendUserVerifyRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserVerifyRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserVerifyRepository', $frontendUserVerifyRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFrontendUserVerifyToView() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('frontendUserVerify', $frontendUserVerify);

		$this->subject->showAction($frontendUserVerify);
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFrontendUserVerifyToView() {
		$frontendUserVerify = new \Wewo\Wewoshop\Domain\Model\FrontendUserVerify();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('frontendUserVerify', $frontendUserVerify);

		$this->subject->showAction($frontendUserVerify);
	}
}
