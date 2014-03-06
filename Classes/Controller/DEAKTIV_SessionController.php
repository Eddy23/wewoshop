<?php
/**
 * Created by JetBrains PhpStorm.
 * User: etti
 * Date: 16.05.13
 * Time: 19:31
 * To change this template use File | Settings | File Templates.
 */

namespace Wewo\Wewoshop\Controller;


class SessionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * The object repository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\ObjectRepository
     * @inject
     */
    protected $objectRepository = NULL;

/*
    public function initializeAction() {
        // get an instance of the OBJECT repository
        $this->objectRepository = t3lib_div::makeInstance('Tx_MyExt_Domain_Repository_ObjectRepository');
    }
*/
    /**
     * The session will be stored
     *
     * @param \Wewo\Wewoshop\Domain\Model\Product $product
     * @return void
     */
    public function storeObjectIntoSessionAction(\Wewo\Wewoshop\Domain\Model\Product $product) {

        $object = array (
            'Produktname' => $product->getProductTitle(),
            'Farbe' => $product->getColor()
        );

        $this->objectRepository->writeToSession($object);
        $this->view->assign('object', $object);
    }

    /**
     * The session will be restored
     *
     * @return void
     */
    public function restoreObjectFromSessionAction() {
        $object = $this->objectRepository->findBySession();
        $this->view->assign('object', $object);
    }
}
?>