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
class ProductController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * productRepository
	 *
	 * @var \Wewo\Wewoshop\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository;


    /**
     * categoryRepository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;


    /**
     * The object repository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\ObjectRepository
     * @inject
     */
    protected $objectRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();
//        \TYPO3\CMS\Core\Utility\DebugUtility::debug($categories);
        $ausgabe = $GLOBALS['TSFE']->fe_user->getKey('ses', 'session_name');
        $sid = $GLOBALS['TSFE']->fe_user->id;
        //var_dump($ausgabe,'in session vorhanden');

        echo "<pre>";
        echo "Ausgabe direkt aus der listAction<br /><br />";
        if(!empty($ausgabe)) {
            print_r($ausgabe);
        } else {
            // Session mit leeren Werten anlegen, falls noch keine Session besteht.
            // Begründung: Nur dadurch kann genau diese Session gemerkt werden und ändert sich nicht nach jedem Seitenaufruf
            $GLOBALS['TSFE']->fe_user->setKey('ses', 'session_name', '');
            echo "Keine Daten in der Session";
        }
        echo "</pre>";

		$this->view->assign('products', $products);
        $this->view->assign('categories', $categories);
        $this->view->assign('ausgabe', $ausgabe);
        $this->view->assign('sid', $sid);
	}


    /**
     * action saveInSession
     *
     * @param \Wewo\Wewoshop\Domain\Model\Product $product
     * @return void
     */
    public function saveInSessionAction(\Wewo\Wewoshop\Domain\Model\Product $product = NULL) {
        $productSessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'session_name');
//        var_dump($productSessionData,'Sessioninhalt vor Änderungen');
//        echo "<pre>";
//        print_r($productSessionData);
//        echo "</pre>";

        if(empty($productSessionData)) {
//            echo "<h1>Noch keine Sessiondaten vorhanden</h1>";
            $productSessionData[] = array (
                'Produktname' => $product->getProductTitle(),
                'Farbe' => $product->getColor()
            );
        } else {
//            echo "<h1>Sessiondaten werden hinzugefügt</h1>";
            $productSessionDataNeu = array (
                'Produktname' => $product->getProductTitle(),
                'Farbe' => $product->getColor()
            );
            array_push($productSessionData,$productSessionDataNeu);
        };


        $GLOBALS['TSFE']->fe_user->setKey('ses', 'session_name', $productSessionData);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
        $productSessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'session_name');
//        echo "<br /><br />";
//        echo "<pre>";
//      print_r($productSessionData);
//        echo "</pre>";
//        var_dump($productSessionData,'Sessioninhalt nach Änderungen');
        $this->forward('list','Product');
    }

    /**
     * action sortlist is sorting the listview with a category
     *
     * @return void
     */
    public function sortListAction() {
         // ohne flashmessage funktioniert die Filterung nicht korrekt ???
        $this->flashMessageContainer->add('Filterung wurde durchgeführt.');
        $categories = $this->categoryRepository->findAll();

        $catId =  $this->request->getArgument('productCategory');
        // Aufruf aus der listAction => productCategory ist ein Array
        // Aufruf aus der showAction => productCategory ist kein Array, hat als Kategorienummer bereits
        if(is_array($catId)){
            $catId = $catId[categories];
        }
        $productsCatId = $this->productRepository->findByCategory($catId);

        $this->view->assign('productsCatId', $productsCatId);
        $this->view->assign('categories', $categories);
    }


    /**
     * action search is searching for desired product/products
     *
     * @return void
     */
    public function searchAction() {
        // gets the POST-value from the searchformular
        $queryString = $this->request->getArgument('searchBox');
        //trim special and space characters in queryString
        $replace = array(' ','&nbsp;');
        $queryString = trim($queryString);
        $queryString = str_replace($replace,'',$queryString);
        // go to listaction if querystring is false
        if(!isset($queryString) || $queryString == '' || (empty($queryString))) {
            $this->flashMessageContainer->add('Es wurden keine korrekten Suchkriterien eingegeben.');
            $this->redirect('list');
        } else {
            // search table with POST-value
            $foundProducts = $this->productRepository->findByTitle($queryString);
            $this->view->assign('foundProducts', $foundProducts);
            $this->view->assign('queryString', $queryString);
        }
    }


    /**
	 * action show
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Product $product
	 * @return void
	 */
	public function showAction(\Wewo\Wewoshop\Domain\Model\Product $product) {
		$checkArguments = $this->request->getArguments();
        if (array_key_exists('changeShowView', $checkArguments)) {
            //echo "Der Key 'changeShowView' ist in dem Array 'checkArguments' vorhanden";
            $this->view->assign('changeShowView', TRUE);
        }
        if (array_key_exists('changeShowViewSearch', $checkArguments)) {
            //echo "Der Key 'changeShowViewSearch' ist in dem Array 'checkArguments' vorhanden";
            $this->view->assign('changeShowViewSearch', TRUE);
            $queryString = $this->request->getArgument('queryString');
            $this->view->assign('queryString', $queryString);
        }
        $this->view->assign('product', $product);
	}

	/**
	 * action new
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Product $newProduct
	 * @dontvalidate $newProduct
	 * @return void
	 */
	public function newAction(\Wewo\Wewoshop\Domain\Model\Product $newProduct = NULL) {
		$this->view->assign('newProduct', $newProduct);
	}

	/**
	 * action create
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Product $newProduct
	 * @return void
	 */
	public function createAction(\Wewo\Wewoshop\Domain\Model\Product $newProduct) {
		$this->productRepository->add($newProduct);
		$this->flashMessageContainer->add('Your new Product was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Product $product
	 * @return void
	 */
	public function editAction(\Wewo\Wewoshop\Domain\Model\Product $product) {
		$this->view->assign('product', $product);
	}

	/**
	 * action update
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Product $product
	 * @return void
	 */
	public function updateAction(\Wewo\Wewoshop\Domain\Model\Product $product) {
		$this->productRepository->update($product);
		$this->flashMessageContainer->add('Your Product was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Product $product
	 * @return void
	 */
	public function deleteAction(\Wewo\Wewoshop\Domain\Model\Product $product) {
		$this->productRepository->remove($product);
		$this->flashMessageContainer->add('Your Product was removed.');
		$this->redirect('list');
	}


}
?>