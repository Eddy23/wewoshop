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
 * Verwaltung der FrontendUser mittels fe_users
 *
 * @package wewoshop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FrontendUserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
	 * frontendUserRepository
	 *
	 * @var \Wewo\Wewoshop\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository;


	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
        $frontendUsers = $this->frontendUserRepository->findAll();
//        $frontendUsers = $this->frontendUserRepository->findByUid(1);
		$this->view->assign('frontendUsers', $frontendUsers);
	}

    /**
     * action verify frontenduser
     *
     * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
     * @return void
     */
    public function verifyFeUserAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser) {
     }

    /**
	 * action show
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function showAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser) {
		$this->view->assign('frontendUser', $frontendUser);
	}

	/**
	 * action new
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $newFrontendUser
	 * @dontvalidate $newFrontendUser
	 * @return void
	 */
	public function newAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $newFrontendUser = NULL) {
		$this->view->assign('newFrontendUser', $newFrontendUser);
	}


	/**
	 * action create
     *
     * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function createAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser) {
        $table = 'fe_users';

        $firstName = $GLOBALS['TYPO3_DB']->quoteStr(strip_tags($frontendUser->getFirstName()), $table);
        $lastName = $GLOBALS['TYPO3_DB']->quoteStr(strip_tags($frontendUser->getLastName()), $table);
        $address = $GLOBALS['TYPO3_DB']->quoteStr(strip_tags($frontendUser->getAddress()), $table);
        $zip = $GLOBALS['TYPO3_DB']->quoteStr(strip_tags($frontendUser->getZip()), $table);
        $city = $GLOBALS['TYPO3_DB']->quoteStr(strip_tags($frontendUser->getCity()), $table);
        $email = $GLOBALS['TYPO3_DB']->quoteStr(strip_tags($frontendUser->getEmail()), $table);
        $password = $GLOBALS['TYPO3_DB']->quoteStr(strip_tags($frontendUser->getPassword()), $table);
        $confirmationPassword = $GLOBALS['TYPO3_DB']->quoteStr(strip_tags($frontendUser->getConfirmationPassword()), $table);

        // Generate Salted Password
        $objSalt = \TYPO3\CMS\Saltedpasswords\Salt\SaltFactory::getSaltingInstance(NULL);
        if (is_object($objSalt)) {
            $password = $objSalt->getHashedPassword($password);
        }

        $frontendUser->setFirstName($firstName);
        $frontendUser->setLastName($lastName);
        $frontendUser->setAddress($address);
        $frontendUser->setZip($zip);
        $frontendUser->setCity($city);
        $frontendUser->setEmail($email);
        $frontendUser->setPassword($password);
        $frontendUser->setConfirmationPassword($confirmationPassword);

     	$this->frontendUserRepository->add($frontendUser);

        // Erstelle ein Orderobjekt als Elterninstanz. Erst wenn Elterninstanz exisitert, können die Kindobjekte "eingehängt" werden (bei entsprechender Relation).
        // $newOrder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Wewo\\Wewoshop\\Domain\\Model\\Orders');

        // Ein add() in das Repository führt noch nicht alleine zu einer Persistierung
        // Es muss zusätzlich noch eine Persistenzmanager-Instanz erstellt werden und persistAll() aufrufen
        // Alternative: Anstatt forward redirect verwenden: Dies löst einen neuen Dispatch aus und Persistencemanager wird nicht benötigt
        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();

//        $this->redirect('showPaymentForm', 'Orders', NULL, array('frontendUser' => $frontendUser, 'newOrder' => $newOrder));
//        $this->forward('new', 'Payment', NULL, array('frontendUser' => $frontendUser));
        $this->forward('feUserLogin', 'FrontendUser', NULL, array('propertyUserName' => $frontendUser->getUserName(), 'feUserPassword' => $password, 'frontendUser' => $frontendUser));
	}


    /**
     * fe_user will be logged in
     *
     * @param string $propertyUserName
     * @param string $feUserPassword
     * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
     * @return bool|string
     */
    public function feUserLoginAction($propertyUserName, $feUserPassword, \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser) {
        $loginData = array(
            'username' => $propertyUserName,
            'uident_text' => $feUserPassword,
            'status' => 'login'
        );
        $GLOBALS['TSFE']->fe_user->checkPid = '';
        $info = $GLOBALS['TSFE']->fe_user->getAuthInfoArray();
        $user = $GLOBALS['TSFE']->fe_user->fetchUserRecord($info['db_user'], $loginData['username']);

        $ok = $GLOBALS['TSFE']->fe_user->compareUident($user, $loginData);
        if ($ok) {
            $GLOBALS['TSFE']->fe_user->createUserSession($user);

            // Diese Anweisung füllt erst die fe_user-Daten, womit sie also nun abrufbar sind mit $_GLOBALS
            $GLOBALS['TSFE']->fe_user->user = $GLOBALS['TSFE']->fe_user->fetchUserSession();
            $GLOBALS['TSFE']->fe_user->fetchGroupData();
        } else {
            // TODO: echo eingabe muss noch überarbeitet werden
            echo "Für FE-User konnte kein Session-Login durchgeführt werden";
        }
        $this->forward('new', 'Payment', NULL, array('frontendUser' => $frontendUser));
    }


	/**
	 * action edit
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function editAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser) {
		$this->view->assign('frontendUser', $frontendUser);
	}

	/**
	 * action update
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function updateAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser) {
		$this->frontendUserRepository->update($frontendUser);
		$this->flashMessageContainer->add('Your FrontendUser was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
	 * @return void
	 */
	public function deleteAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser) {
		$this->frontendUserRepository->remove($frontendUser);
		$this->flashMessageContainer->add('Your FrontendUser was removed.');
		$this->redirect('list');
	}

}
?>