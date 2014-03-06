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
 * Test case for class Wewo\Wewoshop\Controller\CategoryController.
 *
 */
class CategoryControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Wewo\Wewoshop\Controller\CategoryController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Wewo\\Wewoshop\\Controller\\CategoryController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function listActionFetchesAllCategoriesFromRepositoryAndAssignsThemToView() {

		$allCategories = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('findAll'), array(), '', FALSE);
		$categoryRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCategories));
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('categories', $allCategories);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCategoryToView() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('category', $category);

		$this->subject->showAction($category);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenCategoryToView() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newCategory', $category);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($category);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenCategoryToCategoryRepository() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('add'), array(), '', FALSE);
		$categoryRepository->expects($this->once())->method('add')->with($category);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($category);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($category);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($category);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenCategoryToView() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('category', $category);

		$this->subject->editAction($category);
	}


	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenCategoryInCategoryRepository() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('update'), array(), '', FALSE);
		$categoryRepository->expects($this->once())->method('update')->with($category);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($category);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($category);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($category);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenCategoryFromCategoryRepository() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('remove'), array(), '', FALSE);
		$categoryRepository->expects($this->once())->method('remove')->with($category);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($category);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($category);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$category = new \Wewo\Wewoshop\Domain\Model\Category();

		$categoryRepository = $this->getMock('Wewo\\Wewoshop\\Domain\\Repository\\CategoryRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($category);
	}
}
