<?php
namespace Wewo\Wewoshop\Controller;
use Wewo\Wewoshop\Utility\CreateMandatePdf;
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
        $sessionObject = $this->objectRepository->findBySession();
        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        //calculate the sum of positionquantity and the value of the basket
        $basketQuantity = 0;
        $basketValue = 0;
        if (isset($sessionObject) && ($sessionObject != NULL)) {
            foreach ($sessionObject as $basketPosition) {
                foreach ($basketPosition as $positionItem => $positionValue) {
                    if ($positionItem == "Anzahl") {
                        $basketPositionQuantity = $positionValue;
                        $basketQuantity = $basketQuantity + $basketPositionQuantity;
                    }
                    if ($positionItem == "Preis") {
                        $basketPositionValue = 0;
                        i . B .

                        $basketPositionValue = ($positionValue * $basketPositionQuantity);
                        $basketValue = $basketValue + $basketPositionValue;
                    }
                }
            }
        }

        // Links im Miniwarenkorb (Wk anzeigen, Wk löschen) nur einblenden, wenn etwas darin liegt
        if ($basketQuantity > 0 && $basketValue > 0) {
            $basketLinks = TRUE;
            $this->view->assign('basketLinks', $basketLinks);
        }

        // Wurde direkt nach dem Bestellvorgang F5 gedrückt oder Zurück-/Vor-Buttons benutzt, wird hierher umgeleitet
        // und eine Fehlermeldung/Erklärung ausgegeben
        if ($this->request->hasArgument('errormessage')) {
            $this->view->assign('errormessage', TRUE);
        }

        $this->view->assign('products', $products);
        $this->view->assign('categories', $categories);
        $this->view->assign('basketQuantity', $basketQuantity);
        $this->view->assign('basketValue', $basketValue);
	}


    /**
     * action saveInSession
     *
     * @param \Wewo\Wewoshop\Domain\Model\Product $product
     * @return void
     */
    public function saveInSessionAction(\Wewo\Wewoshop\Domain\Model\Product $product = NULL) {
        $productSessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'session_name');

        if(empty($productSessionData)) {
            $productSessionData[] = array (
                'Produktname' => $product->getProductTitle(),
                'Farbe' => $product->getColor()
            );
        } else {
            $productSessionDataNeu = array (
                'Produktname' => $product->getProductTitle(),
                'Farbe' => $product->getColor()
            );
            array_push($productSessionData,$productSessionDataNeu);
        };


        $GLOBALS['TSFE']->fe_user->setKey('ses', 'session_name', $productSessionData);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
        $productSessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'session_name');
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
//        $sidtypo3 = $GLOBALS['TSFE']->fe_user;
//        \TYPO3\CMS\Core\Utility\DebugUtility::debug($sidtypo3);

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


    /**
     * The session will be stored
     *
     * @param \Wewo\Wewoshop\Domain\Model\Product $product
     * @param integer $positionQuantity
     * @validate $positionQuantity \Wewo\Wewoshop\Domain\Validator\BasketQuantityValidator
     * @return void
     */
    public function storeObjectIntoSessionAction(\Wewo\Wewoshop\Domain\Model\Product $product, $positionQuantity = 0) {

        $productSessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_wewoshop_pi1');
        // Kommt Anforderung aus Warenkorb zur Änderung einer Positionsmenge
        if($this->request->hasArgument('changeBasketPositionFlag')) {
            $changeBasketPositionFlag = TRUE;
        } else {
            $changeBasketPositionFlag = FALSE;
        }

        $productSessionDataNeu[] = array (
            'Produktname' => $product->getProductTitle(),
            'Anzahl' => $positionQuantity,
            'Imagesmall' => $product->getProductImgSmall(),
            'Produktuid' => $product->getUid(),
            'Preis' => $product->getPrice(),
            'Positionsbetrag' => ($positionQuantity * $product->getPrice()),
            'Useruid' => '',
            'Bezahlmethode' => ''
        );

        if(empty($productSessionData)) {
            $this->objectRepository->writeToSession($productSessionDataNeu);
        } else {
            $productSessionData = unserialize($productSessionData);
            // Die Menge eines bestehenden Artikels im Warenkorb wird mit der Menge des frisch hinzugekommenen Artikels neu berechnet
            foreach ($productSessionData as $row) {
                $productTitleVector = $row['Produktname'];
                $productQuantityVector = $row['Anzahl'];

                // Kommt die neue Menge nicht von einer Warenkorbpositionsänderung (sondern aus der Einzelansicht), dann ist sie zu addieren
                if(($changeBasketPositionFlag === FALSE) && ($productTitleVector == $product->getProductTitle())) {
                    $positionQuantity = $positionQuantity + $productQuantityVector;
//                    $positionAmount = $positionQuantity * $row['Preis'];
                    break;
                }
            }

            foreach($productSessionData as $sessionKey => $sessionValue) {
                foreach($sessionValue as $productKey => $productValue) {
                    if($productValue == $product->getProductTitle()) {
                        $productSessionData[$sessionKey]['Anzahl'] = $positionQuantity;
                        $productSessionData[$sessionKey]['Positionsbetrag'] = ($positionQuantity * $product->getPrice());
                        // Produkt wurde für alten Warenkorb verwendet/neu berechnet => wird nicht mehr gebraucht => löschen
                        unset($productSessionDataNeu);
                        // Wenn gefunden, dann alle drei foreach-Schleifen abbrechen
                        break 2;
                    }
                }
            }

            // Existiert neues Produkt noch nicht im Warenkorb, dann an den bisherigen Warenkorb anhängen
            if(isset($productSessionDataNeu)) {
                $productSessionData = array_merge($productSessionData,$productSessionDataNeu);
                unset($productSessionDataNeu);
            }
            $this->objectRepository->writeToSession($productSessionData);
        };
        if($changeBasketPositionFlag === FALSE) {
            $this->redirect('list');
        } else {
            $this->redirect('restoreObjectFromSession');
        }
    }




    /**
     * The session will be restored => All products in the session will be shown
     *
     * @return void
     */
    public function restoreObjectFromSessionAction() {
        $sessionObject = $this->objectRepository->findBySession();
        $this->view->assign('sessionobject', $sessionObject);
    }


    /**
     * The quantity in a basketposition was changed => update the session
     *
     * @param integer $positionQuantity
     * @return void
     */
    public function changeBasketQuantityAction($positionQuantity) {
//      $positionQuantity = $this->request->getArgument('positionquantity');
        $productUid = $this->request->getArgument('productuid');
        $specialProduct = $this->productRepository->findByUid($productUid);
//        $this->forward('storeObjectIntoSession', NULL, NULL, array('product' => $specialProduct, 'positionQuantity' => $positionQuantity, 'changeBasketPositionFlag' => TRUE));
        if($positionQuantity > 0) {
            $this->forward('storeObjectIntoSession', NULL, NULL, array('product' => $specialProduct, 'positionQuantity' => $positionQuantity, 'changeBasketPositionFlag' => TRUE));
        } else {
            $this->forward('restoreObjectFromSession');
        }
     }


    /**
     * Deactivate standard errorFlashMessage
     * Then use individual error messaging (i.e. Resources/Private/Partials/formErrors.html)
     * that means: the origin method in ActionController.php will be overwriting with FALSE
     *
     * @return bool|string
     */
    public function getErrorFlashMessage() {
        return FALSE;
    }


    /**
     * Delete one Position of the basket/session
     *
     * @return void
     */
    public function deleteBasketPositionAction() {
        $productUid = $this->request->getArgument('productuid');

        $specialProduct = $this->productRepository->findByUid($productUid);

        $productSessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_wewoshop_pi1');
        $productSessionData = unserialize($productSessionData);

        foreach ($productSessionData as $hauptkey1 => $hauptvalue1) {
            if($hauptvalue1['Produktuid'] == $productUid) {
                unset($productSessionData[$hauptkey1]);
                $this->objectRepository->writeToSession($productSessionData);
                break;
            }
        }
        $this->redirect('restoreObjectFromSession');
    }


    /*
     * The session will be deleted
     *
     * @return void
     */
    public function deleteSessionAction() {
        $this->objectRepository->cleanUpSession();
        $this->redirect('list');
    }
}
?>