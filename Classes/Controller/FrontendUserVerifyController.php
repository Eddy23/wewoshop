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
 * Check, ob angemeldeter User bereits registriert ist
 *
 * @package wewoshop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FrontendUserVerifyController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * frontendUserVerifyRepository
	 *
	 * @var \Wewo\Wewoshop\Domain\Repository\FrontendUserVerifyRepository
	 * @inject
	 */
	protected $frontendUserVerifyRepository;

    /**
     * frontendUserRepository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $frontendUserRepository;


    /**
     * The object repository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\ObjectRepository
     * @inject
     */
    protected $objectRepository = NULL;

    /**
     * The Model FrontendUser
     *
     * @var \Wewo\Wewoshop\Domain\Model\FrontendUser
     * @inject
     */
    protected $frontendUser;

    /**
     * action showForm
     *
     * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
     * @ignorevalidation  $frontendUser
     * @return void
     */
    public function showFormAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser = NULL) {
        // Ist User bereits eingeloggt, dann gleich weiter zu Show.html im Payment Controller (=Zahlungsart wählen)
        if($GLOBALS['TSFE']->loginUser) {
            $this->forward('new', 'Payment', NULL, NULL);
        }

        $frontendUserVerifies = $this->frontendUserVerifyRepository->findAll();
        $this->view->assign('frontendUserVerifies', $frontendUserVerifies);

         // Dummy FE-Username
        $dummyUserName = "feUser-" . $GLOBALS['EXEC_TIME'];

        $this->view->assign('frontendUser', $this->frontendUser);
        $this->view->assign('dummyUserName', $dummyUserName);

        if ($this->request->hasArgument('errormessage')) {
            $this->view->assign('errormessage', TRUE);
        }
    }


    /**
     * action showPaymentForm
     *
     * @return void
     */
    public function showPaymentFormAction() {
        $this->view->assign('testausgabe', 'Das ist ein Testtext23');
    }

    /**
     * action verifyFeUser
     *
     * @param \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerifies
     * @return void
     */
    public function verifyFeUserAction(\Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerifies) {
        // Userdaten aus Formular
        $propertyEmail = $frontendUserVerifies->getEmail();
        $propertyPassword = $frontendUserVerifies->getPassword();

        // Entsprechendes Userobject anhand übergebener Email-Adresse ermitteln ...
        $feUserObject = $this->frontendUserVerifyRepository->findOneByEmail($propertyEmail);
        if(isset($feUserObject)) {
            // ...und salted Passwort aus Repository/Tabelle auslesen
            // TODO: Falls ein User mehrere Anmeldungen mit der gleichen Email-Adresse gemacht hat, evtl. checken
            $feUserPassword = $feUserObject->getPassword();

            // Prüfen, ob eingegebenes Passwort und salted Passwort aus Repository übereinstimmen
            $objSalt = \TYPO3\CMS\Saltedpasswords\Salt\SaltFactory::getSaltingInstance($feUserPassword);
            if (is_object($objSalt)) {
                $success = $objSalt->checkPassword($propertyPassword, $feUserPassword);
            }

            // Wenn ja, feUser uid ermitteln ...
            if($success) {
                $feUserId = $feUserObject->getUid();
                // ... Sessiondaten holen und feUserId in die Sessiondaten integrieren, falls noch nicht vorhanden
                $sessionObject = $this->objectRepository->findBySession();
                foreach ($sessionObject as $sessionKey => $sessionValue) {
                    foreach ($sessionValue as $productKey => $productValue) {
                        $sessionObject[$sessionKey]['Useruid'] = $feUserId;
                    }
                }
                $this->objectRepository->writeToSession($sessionObject);

                // Mit dem username des feUserObject den User einloggen als FE-User
                $propertyUserName = $feUserObject->getUserName();
                //$this->feUserLogin($propertyUserName, $feUserPassword );
                $this->forward('feUserLogin', NULL, NULL, array('propertyUserName' => $propertyUserName, 'feUserPassword' => $feUserPassword, 'feUserObject' => $feUserObject));
            } else {
                $this->forward('showForm', NULL, NULL, array('errormessage' => TRUE));
            }
        } else {
            $this->forward('showForm', NULL, NULL, array('errormessage' => TRUE));
        }
    }


    /**
     * fe_user will be logged in
     *
     * @param string $propertyUserName
     * @param string $feUserPassword
     * @param \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $feUserObject
     * @return bool|string
     */
    public function feUserLoginAction($propertyUserName, $feUserPassword, \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $feUserObject) {
        $loginData = array(
            'username' => $propertyUserName,
            'uident_text' => $feUserPassword,
            'status' => 'login'
        );
        $GLOBALS['TSFE']->fe_user->checkPid = '';
        $info = $GLOBALS['TSFE']->fe_user->getAuthInfoArray();
        $user = $GLOBALS['TSFE']->fe_user->fetchUserRecord($info['db_user'], $loginData['username']);

        $ok = $GLOBALS['TSFE']->fe_user->compareUident($user, $loginData);
        if($ok) {
            $GLOBALS['TSFE']->fe_user->createUserSession($user);

            // Diese Anweisung füllt erst die fe_user-Daten, womit sie also nun abrufbar sind mit $_GLOBALS
            $GLOBALS['TSFE']->fe_user->user = $GLOBALS['TSFE']->fe_user->fetchUserSession();
            $GLOBALS['TSFE']->fe_user->fetchGroupData();
            // TODO: Hier muss ein frontendUser-Object übergeben werden und kein frontendUserVerify
            // feUserID wäre ausreichend (müsste dann auch von frontendUserController - feUserLoginAction übergeben werden)
            //$this->forward('new', 'Payment', NULL, array('feUserObject' => $feUserObject));

            $this->forward('new', 'Payment', NULL, array('feUserId' => $GLOBALS['TSFE']->fe_user->user['uid']));
        } else {
            // TODO: echo noch umschreiben
            echo "login nicht erfolgreich";
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
     * action list
     *
     * @return void
     */
    public function listAction() {
        $frontendUserVerifies = $this->frontendUserVerifyRepository->findAll();
        $this->view->assign('frontendUserVerifies', $frontendUserVerifies);
    }


	/**
	 * action show
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerify
	 * @return void
	 */
	public function showAction(\Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerify) {
		$this->view->assign('frontendUserVerify', $frontendUserVerify);
	}

	/**
	 * action new
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $newFrontendUserVerify
	 * @dontvalidate $newFrontendUserVerify
	 * @return void
	 */
	public function newAction(\Wewo\Wewoshop\Domain\Model\FrontendUserVerify $newFrontendUserVerify = NULL) {
		$this->view->assign('newFrontendUserVerify', $newFrontendUserVerify);
	}

	/**
	 * action create
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $newFrontendUserVerify
	 * @return void
	 */
	public function createAction(\Wewo\Wewoshop\Domain\Model\FrontendUserVerify $newFrontendUserVerify) {
		$this->frontendUserVerifyRepository->add($newFrontendUserVerify);
		$this->flashMessageContainer->add('Your new FrontendUserVerify was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerify
	 * @return void
	 */
	public function editAction(\Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerify) {
		$this->view->assign('frontendUserVerify', $frontendUserVerify);
	}

	/**
	 * action update
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerify
	 * @return void
	 */
	public function updateAction(\Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerify) {
		$this->frontendUserVerifyRepository->update($frontendUserVerify);
		$this->flashMessageContainer->add('Your FrontendUserVerify was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerify
	 * @return void
	 */
	public function deleteAction(\Wewo\Wewoshop\Domain\Model\FrontendUserVerify $frontendUserVerify) {
		$this->frontendUserVerifyRepository->remove($frontendUserVerify);
		$this->flashMessageContainer->add('Your FrontendUserVerify was removed.');
		$this->redirect('list');
	}



}
?>