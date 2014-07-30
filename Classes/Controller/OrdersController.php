<?php
namespace Wewo\Wewoshop\Controller;
use Wewo\Wewoshop\Utility\CalculateOrderAmount;
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
class OrdersController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * ordersRepository
	 *
	 * @var \Wewo\Wewoshop\Domain\Repository\OrdersRepository
	 * @inject
	 */
	protected $ordersRepository;

    /**
     * The object repository
     * The session object
     *
     * @var \Wewo\Wewoshop\Domain\Repository\ObjectRepository
     * @inject
     */
    protected $objectRepository = NULL;

    /**
     * The payment repository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\PaymentRepository
     * @inject
     */
    protected $paymentRepository = NULL;

    /**
     * frontendUserRepository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $frontendUserRepository;


    /**
     * The Model DeliverAddress
     *
     * @var \Wewo\Wewoshop\Domain\Model\DeliveryAddress
     * @inject
     */
    protected $deliveryAddress;


	/**
	 * action list
     *
     * @param \integer $feUserId
	 * @return void
	 */
	public function listAction($feUserId) {
        $frontendUser = $this->frontendUserRepository->findByUid($feUserId);
        $sessionObjects = $this->objectRepository->findBySession();

            $currentDeliveryAddress = $frontendUser->getDeliveryAddresses();
            $currentDeliveryAddress = $currentDeliveryAddress->current();
            if($currentDeliveryAddress !== NULL) {
                // Nun zwei alternative Möglichkeiten
                // Entweder hier im Controller die einzelnen DeliveryAddress Properties  ermitteln und einzeln zuweisen, z.B. den firstNameDelivery:
                // $currentFirstName = $currentDeliveryAddress->getFirstNameDelivery
                // oder besser die Zuweisung erst in Fluid machen, d.h. hier $currentDeliveryAddress komplett übergeben und in Fluid über die Punktnotation zugreifen:
                $this->view->assign('currentDeliveryAddress', $currentDeliveryAddress);
            }


        $this->view->assign('feUser', $frontendUser);
        $this->view->assign('sessionObjects', $sessionObjects);
        $this->view->assign('totalAmount', CalculateOrderAmount::addOrderPositionAmounts($sessionObjects));
    }


    /**
	 * action show
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Orders $orders
	 * @return void
	 */
	public function showAction(\Wewo\Wewoshop\Domain\Model\Orders $orders) {
		$this->view->assign('orders', $orders);
	}

	/**
	 * action new
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Orders $newOrders
	 * @dontvalidate $newOrders
	 * @return void
	 */
	public function newAction(\Wewo\Wewoshop\Domain\Model\Orders $newOrders = NULL) {
        $this->view->assign('newOrders', $newOrders);
	}


    /**
     * action showPaymentForm
     *
     * @param \Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser
     * @return void
     */
    public function showPaymentFormAction(\Wewo\Wewoshop\Domain\Model\FrontendUser $frontendUser) {
        // $newPayment = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Wewo\\Wewoshop\\Domain\\Model\\Payment');
        // $deliveryAddress = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Wewo\\Wewoshop\\Domain\\Model\\DeliveryAddress');

        // Erstelle ein Orderobjekt als Elterninstanz. Erst wenn Elterninstanz exisitert, können die Kindobjekte "eingehängt" werden (bei entsprechender Relation).
        // $newOrder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Wewo\\Wewoshop\\Domain\\Model\\Orders');

        // $this->view->assign('newOrder', $newOrder);
        // $this->view->assign('newPayment', $newPayment);
        // $this->view->assign('deliveryAddress', $deliveryAddress);
        /*
                // TODO: Hier muss entweder Userobject des feUserVerify vorhanden sein oder Userobject des feUsers
                // Also eines der beiden Objekte muss auf jedenfall hier vorhanden sein (Struktur der beiden feUsers-Objekte sollte gleich sein)

                if (isset($feUserObject)) {
                    $this->view->assign('feUserObject', $feUserObject);
                } else if (isset($frontendUser)) {
                    $this->view->assign('frontendUser', $frontendUser);
                }
        */
        $this->view->assign('frontendUser', $frontendUser);
    }

    /**
     * action paymentMethodToSession
     * adds the paymentmethod to the sessiondata
     *
     * @return void
     */
    public function paymentMethodToSessionAction() {
        if(($this->request->getArgument('paymentMethods')) > 0) {
            $paymentMethod = 1;
        }


        $sessionObject = $this->objectRepository->findBySession();
        foreach ($sessionObject as $sessionKey => $sessionValue) {
            foreach ($sessionValue as $productKey => $productValue) {
                //$sessionObject[$sessionKey]['Bezahlmethode'] = $payment->getPaymentMethod();
                $sessionObject[$sessionKey]['Bezahlmethode'] = $paymentMethod;
            }
        }
        $this->objectRepository->writeToSession($sessionObject);
       // $this->redirect('list', 'Orders', NULL, array('payment' => $payment));
        $this->redirect('list', 'Orders', NULL, NULL);
    }


    /**
	 * action create
     * generate an order with sessiondata
	 *
	 * @return void
	 */
	public function createAction() {
         // ... Sessiondaten holen
        $sessionObjects = $this->objectRepository->findBySession();

        // ...falls nicht vorhanden (z.B. wenn F5 gedrückt wurde nach beendetem Bestellvorgang), an listAction im ProductController umleiten
        if ($sessionObjects === FALSE) {
            $this->redirect('list', 'Product', NULL, array('errormessage' => TRUE));
        }

        // Bestellnummer generieren
        $orderNr = $this->ordersRepository->generateOrderNumber();

        // ... und mit diesen Daten ein/mehrere Orderobjekte bestücken
        foreach ($sessionObjects as $sessionKey => $sessionValue) {
            // In jedem Schleifendurchlauf leeres Orderobjekt referenzieren
            // Dadurch wird für jedes Orderobjekt ein eigener Datensatz im Repository/DB-Tabelle angelegt
            $newOrders = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Wewo\\Wewoshop\\Domain\\Model\\Orders');
            $newOrders->setOrderNr($orderNr);
            $newOrders->setOrderPositionNr($sessionKey + 1);
            $newOrders->setOrderPositionVolume($sessionObjects[$sessionKey]['Anzahl']);
            $newOrders->setProductUid($sessionObjects[$sessionKey]['Produktuid']);
            $newOrders->setFeUserUid($sessionObjects[$sessionKey]['Useruid']);
            $newOrders->setPaymentMethod($sessionObjects[$sessionKey]['Bezahlmethode']);
            $newOrders->setMandate($sessionObjects[$sessionKey]['Mandat']);
            $newOrders->setMandateReference($sessionObjects[$sessionKey]['Mandatsreferenz']);
            $this->ordersRepository->add($newOrders);
        }
        $this->forward('confirm', NULL, NULL, array('orderNumber' => $orderNr));
	}

    /**
     * action confirm
     *
     * @return void
     */
    public function confirmAction() {
        if ($this->request->hasArgument('orderNumber')) {
            $orderNr = $this->request->getArgument('orderNumber');
        } else {
            $orderNr = 0;
        }

        // ... Sessiondaten holen
        $sessionObjects = $this->objectRepository->findBySession();

        // Uservornamen und Nachnamen holen und zusammensetzen
        $userFirstName = $GLOBALS['TSFE']->fe_user->user['first_name'];
        $userLastName = $GLOBALS['TSFE']->fe_user->user['last_name'];
        $userName = $userFirstName . ' ' . $userLastName;

        // E-Mailadresse des Users holen
        $userMail = $GLOBALS['TSFE']->fe_user->user['email'];

        // E-Mailadresse (als Senderadresse) des Shops aus dem Konstanteneditor holen
        $shopMail = $this->settings['emailSender'];

        // E-Mailadresse (als Auftragsbearbeitungsstelle) des Shops aus dem Konstanteneditor holen
        $incomingOrdersMail = $this->settings['emailIncomingOrders'];

        // Betreffzeile für Bestätigungsmail an den Kunden aus dem Konstanteneditor holen
        $shopMailSubject = $this->settings['emailSubject'];

        // Betreffzeile für Auftragseingangsmail ab den Shop aus dem Konstanteneditor holen
        $shopMailSubjectIncomingOrder = $this->settings['emailSubjectShop'];

        // PDF-Mandat erstellen
        if ($sessionObjects[0]['Bezahlmethode'] == 1) {
            $sepaPayee = $this->settings['sepaPayee'];
            $sepaCreditor = $this->settings['sepaCreditor'];
            $mandateReference = $sessionObjects[0]['Mandatsreferenz'];
            $bic = $sessionObjects[0]['BIC'];
            $iban = $sessionObjects[0]['IBAN'];
            $today = date("d.m.Y");

            // Prüfen, ob Eintrag in Konstanten-Editor existiert
            if(!$this->settings['directoryToMandate']) {
                $this->settings['directoryToMandate'] = "Mandate";
            }

            // Prüfen, ob das entsprechende Verzeichnis physisch existiert
            $checkDir = PATH_site . 'fileadmin/' . $this->settings['directoryToMandate'];
            if(!is_dir($checkDir)) {
                mkdir($checkDir);
            }

            $mandateFile = $checkDir . '/Lastschrift_Mandat_' . $mandateReference . '.pdf';

            if (DIRECTORY_SEPARATOR == '/'){
                // Attachmentfile und Downloadlink für Linux Server
                $attachementFile = '/fileadmin/' . $this->settings['directoryToMandate'] . '/Lastschrift_Mandat_' . $mandateReference . '.pdf';
                $downloadLink = '<a href = "' . '/fileadmin/' . $this->settings['directoryToMandate'] . '/Lastschrift_Mandat_' . $mandateReference . '.pdf">Ihr Mandat zum Download </a >';
            } else {
                // Attachmentfile und Downloadlink für Windows localhost
                $attachementFile = $GLOBALS['_SERVER']['DOCUMENT_ROOT'] . '/Entwicklung/extdevelop/fileadmin/' . $this->settings['directoryToMandate'] . '/Lastschrift_Mandat_' . $mandateReference . '.pdf';
                $downloadLink = '<a href = "' . '/Entwicklung/extdevelop/fileadmin/' . $this->settings['directoryToMandate'] . '/Lastschrift_Mandat_' . $mandateReference . '.pdf">Ihr Mandat zum Download </a >';
            }

            // PDF wird zusammengebaut
            CreateMandatePdf::createMandate($sepaPayee, $sepaCreditor, $mandateReference, $userName, $GLOBALS['TSFE']->fe_user->user['address'], $GLOBALS['TSFE']->fe_user->user['zip'], $GLOBALS['TSFE']->fe_user->user['city'], $GLOBALS['TSFE']->fe_user->user['email'], $bic, $iban, $today, $this->settings['directoryToMandate']);
        }


        //$this->sendTemplateEmail(array('recipient@domain.tld' => 'Recipient Name'), array('sender@domain.tld' => 'Sender Name', 'Email Subject', 'TemplateName', array('someVariable' => 'Foo Bar'));
        // E-Mail an Kunde
        $this->sendTemplateEmail(array($userMail => 'Kunde'),
                                                    array($shopMail => 'Testshop'),
                                                    $shopMailSubject,
                                                    'ConfirmEmail',
                                                    array(
                                                        'orderNumber' => $orderNr,
                                                        'sessionObjects' => $sessionObjects,
                                                        'totalAmount' => CalculateOrderAmount::addOrderPositionAmounts($sessionObjects),
                                                        'orderDate' => date("d.m.Y"),
                                                        'userName' => $userName,
                                                        'attachementFile' => $attachementFile
                                                    ));

        // E-Mail an Shop Auftragseingang
        $this->sendTemplateEmail(array($incomingOrdersMail => 'Auftragsbearbeitung'),
                                                    array($shopMail => 'Testshop'),
                                                    $shopMailSubjectIncomingOrder,
                                                    'ConfirmEmail',
                                                    array(
                                                        'orderNumber' => $orderNr,
                                                        'sessionObjects' => $sessionObjects,
                                                        'totalAmount' => CalculateOrderAmount::addOrderPositionAmounts($sessionObjects),
                                                        'orderDate' => date("d.m.Y"),
                                                        'userName' => $userName,
                                                        'attachementFile' => $attachementFile
                                                    ));

       $this->view->assign('orderNumber', $orderNr);
       $this->view->assign('downloadLink', $downloadLink);

        // Sessiondaten löschen
        $this->objectRepository->cleanUpSession();
    }

    /**
     * send confirm email with fluid template
     *
     * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
     * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
     * @param string $subject subject of the email
     * @param string $templateName template name (UpperCamelCase)
     * @param array $variables variables to be passed to the Fluid view
     * @return boolean TRUE on success, otherwise false
     */
    protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array()) {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
        $emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
        $templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.html';
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);
        $emailBody = $emailView->render();

        /** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
        $message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $message->setTo($recipient)
                        ->setFrom($sender)
                        ->setSubject($subject);

        if(!empty($variables['attachementFile'])) {
            $attachementFile = $variables['attachementFile'];
            $message->attach(\Swift_Attachment::fromPath($attachementFile));
        }


        // Hier steht noch ein Testkommentar
/*
         // Attachments
        if (count($attachements)) {
            foreach ($attachements as $file => $name) {
                if (file_exists($file)) {
                    if (trim($name)) {
                        $message->attach(\Swift_Attachment::fromPath($file)->setFilename($name));
                    } else {
                        $message->attach(\Swift_Attachment::fromPath($file));
                    }
                }
            }
        }
*/

        // Plain text example
        //$message->setBody($emailBody, 'text/plain');

        // HTML Email
        $message->setBody($emailBody, 'text/html');

        $message->send();
        return $message->isSent();
    }


	/**
	 * action edit
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Orders $orders
	 * @return void
	 */
	public function editAction(\Wewo\Wewoshop\Domain\Model\Orders $orders) {
		$this->view->assign('orders', $orders);
	}

	/**
	 * action update
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Orders $orders
	 * @return void
	 */
	public function updateAction(\Wewo\Wewoshop\Domain\Model\Orders $orders) {
		$this->ordersRepository->update($orders);
		$this->flashMessageContainer->add('Your Orders was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Orders $orders
	 * @return void
	 */
	public function deleteAction(\Wewo\Wewoshop\Domain\Model\Orders $orders) {
		$this->ordersRepository->remove($orders);
		$this->flashMessageContainer->add('Your Orders was removed.');
		$this->redirect('list');
	}

    /**
     * action initializeListBe
     *
     */
    public function initializeListBeAction() {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(FALSE);
        $querySettings->setRespectEnableFields(FALSE);
        $this->ordersRepository->setDefaultQuerySettings($querySettings);
    }

    /**
     * list all orders in the Backend Modul
     *
     */
    public function listBeAction() {
        $this->view->assign('allOrders', $this->ordersRepository->findOpenPurchaseOrder());
        $this->view->assign('finishedOrders', $this->ordersRepository->findFinishedPurchaseOrder());
    }


    /**
     * deletes one order in the Backend Modul
     *
     * @param \Wewo\Wewoshop\Domain\Model\Orders $orders
     * @return void
     */
    public function deleteBeAction(\Wewo\Wewoshop\Domain\Model\Orders $orders) {
        $this->ordersRepository->remove($orders);
        $this->redirect('listBe');
    }
}
?>