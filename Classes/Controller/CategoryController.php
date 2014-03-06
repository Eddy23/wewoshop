<?php
namespace Wewo\Wewoshop\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 *
 *
 * @package wewoshop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CategoryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * categoryRepository
	 *
	 * @var \Wewo\Wewoshop\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$categories = $this->categoryRepository->findAll();
		$this->view->assign('categories', $categories);
	}

	/**
	 * action show
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Category $category
	 * @return void
	 */
	public function showAction(\Wewo\Wewoshop\Domain\Model\Category $category) {
		$this->view->assign('category', $category);
	}

	/**
	 * action new
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Category $newCategory
	 * @dontvalidate $newCategory
	 * @return void
	 */
	public function newAction(\Wewo\Wewoshop\Domain\Model\Category $newCategory = NULL) {
		$this->view->assign('newCategory', $newCategory);
	}

	/**
	 * action create
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Category $newCategory
	 * @return void
	 */
	public function createAction(\Wewo\Wewoshop\Domain\Model\Category $newCategory) {
		$this->categoryRepository->add($newCategory);
		$this->flashMessageContainer->add('Your new Category was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Category $category
	 * @return void
	 */
	public function editAction(\Wewo\Wewoshop\Domain\Model\Category $category) {
		$this->view->assign('category', $category);
	}

	/**
	 * action update
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Category $category
	 * @return void
	 */
	public function updateAction(\Wewo\Wewoshop\Domain\Model\Category $category) {
		$this->categoryRepository->update($category);
		$this->flashMessageContainer->add('Your Category was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Category $category
	 * @return void
	 */
	public function deleteAction(\Wewo\Wewoshop\Domain\Model\Category $category) {
		$this->categoryRepository->remove($category);
		$this->flashMessageContainer->add('Your Category was removed.');
		$this->redirect('list');
	}

}
?>