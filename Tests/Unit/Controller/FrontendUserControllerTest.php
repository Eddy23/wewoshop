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
 * Test case for class Wewo\Wewoshop\Controller\FrontendUserController.
 *
 */
class FrontendUserControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Wewo\Wewoshop\Controller\FrontendUserController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Wewo\\Wewoshop\\Controller\\FrontendUserController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function listActionFetchesAllFrontendUsersFromRepositoryAndAssignsThemToView() {

		$allFrontendUsers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('findAll'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFrontendUsers));
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('frontendUsers', $allFrontendUsers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFrontendUserToView() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('frontendUser', $frontendUser);

		$this->subject->showAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenFrontendUserToView() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newFrontendUser', $frontendUser);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFrontendUserToFrontendUserRepository() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('add'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('add')->with($frontendUser);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenFrontendUserToView() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('frontendUser', $frontendUser);

		$this->subject->editAction($frontendUser);
	}


	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenFrontendUserInFrontendUserRepository() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('update'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('update')->with($frontendUser);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenFrontendUserFromFrontendUserRepository() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('remove'), array(), '', FALSE);
		$frontendUserRepository->expects($this->once())->method('remove')->with($frontendUser);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($frontendUser);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$frontendUser = new \Wewo\Wewoshop\Domain\Model\FrontendUser();

		$frontendUserRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\FrontendUserRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'frontendUserRepository', $frontendUserRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($frontendUser);
	}
}
