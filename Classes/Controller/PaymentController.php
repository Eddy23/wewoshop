<?php
namespace Wewo\Wewoshop\Controller;

    /***************************************************************
     *  Copyright notice
     *  (c) 2013
     *  All rights reserved
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

/**
 * @package wewoshop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class PaymentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * paymentRepository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\PaymentRepository
     * @inject
     */
    protected $paymentRepository;

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
        $payment = $this->paymentRepository->findAll();
        $this->view->assign('payment', $payment);
    }

    /**
     * action show
     *
     * @return void
     */
    public function showAction() {
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction() {
    }

    /**
     * action create
     *
     * @return void
     */
    public function createAction() {
        $args = $this->request->getArguments();
//        Workaround, d.h. zuerst den Persistance-Manager instanzieren, dann muss alles manuell persistiert werden mit persistAll()
//        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
//        $persistenceManager->persistAll();
        $paymentMethodId = intval($args['paymentMethodId']);
        $paymentIban = $args['iban'];
        $paymentBic = $args['bic'];
        $feUserId = intval($GLOBALS['TSFE']->fe_user->user['uid']);

        $this->redirect('paymentMethodToSession', NULL, NULL, array('paymentMethodId' => $paymentMethodId, 'paymentIban' => $paymentIban, 'paymentBic' => $paymentBic, 'feUserId' => $feUserId));
    }

    /**
     * action paymentMethodToSession
     * adds the paymentmethod to the sessiondata
     *
     * @param \integer $paymentMethodId
     * @param \string $paymentIban
     * @param \string $paymentBic
     * @param \integer $feUserId
     * @return void
     */
    public function paymentMethodToSessionAction($paymentMethodId, $paymentIban = NULL, $paymentBic = NULL, $feUserId) {
        if (isset($paymentMethodId) && ($paymentMethodId > 0)) {
            $sessionObject = $this->objectRepository->findBySession();
            foreach ($sessionObject as $sessionKey => $sessionValue) {
                $sessionObject[$sessionKey]['Bezahlmethode'] = $paymentMethodId;
                $sessionObject[$sessionKey]['IBAN'] = $paymentIban;
                $sessionObject[$sessionKey]['BIC'] = $paymentBic;
            }
            $this->objectRepository->writeToSession($sessionObject);
//            $this->redirect('list', 'Orders', NULL, array('frontendUser' => $frontendUser));
            $this->redirect('list', 'Orders', NULL, array('feUserId' => $feUserId));
        } else {
            $this->redirect('new', 'Payment', NULL, NULL);
        }
    }

    /**
     * action edit
     *
     * @param \Wewo\Wewoshop\Domain\Model\Payment $payment
     * @return void
     */
    public function editAction(\Wewo\Wewoshop\Domain\Model\Payment $payment) {
        $this->view->assign('payment', $payment);
    }

    /**
     * action update
     *
     * @param \Wewo\Wewoshop\Domain\Model\Payment $payment
     * @return void
     */
    public function updateAction(\Wewo\Wewoshop\Domain\Model\Payment $payment) {
        $this->paymentRepository->update($payment);
        $this->flashMessageContainer->add('Your Payment was updated.');
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Wewo\Wewoshop\Domain\Model\Payment $payment
     * @return void
     */
    public function deleteAction(\Wewo\Wewoshop\Domain\Model\Payment $payment) {
        $this->paymentRepository->remove($payment);
        $this->flashMessageContainer->add('Your Payment was removed.');
        $this->redirect('list');
    }

    /**
     * A template method for displaying custom error flash messages, or to
     * display no flash message at all on errors. Override this to customize
     * the flash message in your action controller.
     *
     * @return string|boolean The flash message or FALSE if no flash message should be set
     * @api
     */
    protected function getErrorFlashMessage() {
        return 'Error in the Payment-Controller: An error occurred while trying to call ' . get_class($this) . '->' . $this->actionMethodName . '()';
    }
}

?>