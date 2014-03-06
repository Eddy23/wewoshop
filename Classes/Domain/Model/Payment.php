<?php
namespace Wewo\Wewoshop\Domain\Model;


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
class Payment extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * payingmethod is prepayment
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $paymentTitle;

	/**
	 * ID of the paymentMethod
	 *
	 * @var integer
	 */
	protected $paymentMethodId;

	/**
	 * userinput: accountnumber of debit
	 *
	 * @var string
	 */
	protected $debitAccountNumber = '';

	/**
	 * userinput: bankcode of debit
	 *
	 * @var string
	 */
	protected $debitBankCode = '';

	/**
	 * userinput: bankname of debit
	 *
	 * @var string
	 */
	protected $debitBankName = '';

	/**
	 * IBAN
	 *
	 * @var string
	 */
	protected $iban = '';

	/**
	 * BIC
	 *
	 * @var string
	 */
	protected $bic = '';

	/**
	 * One Paymentmethod can have corresponding orders
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wewo\Wewoshop\Domain\Model\Orders>
	 */
	protected $orders;

	/**
	 * Returns the paymentTitle
	 *
	 * @return \string $paymentTitle
	 */
	public function getPaymentTitle() {
		return $this->paymentTitle;
	}

	/**
	 * Sets the paymentTitle
	 *
	 * @param \string $paymentTitle
	 * @return void
	 */
	public function setPaymentTitle($paymentTitle) {
		$this->paymentTitle = $paymentTitle;
	}

	/**
	 * __construct
	 *
	 * @return Payment
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->orders = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a Orders
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Orders $order
	 * @return void
	 */
	public function addOrder(\Wewo\Wewoshop\Domain\Model\Orders $order) {
		$this->orders->attach($order);
	}

	/**
	 * Removes a Orders
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Orders $orderToRemove The Orders to be removed
	 * @return void
	 */
	public function removeOrder(\Wewo\Wewoshop\Domain\Model\Orders $orderToRemove) {
		$this->orders->detach($orderToRemove);
	}

	/**
	 * Returns the orders
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wewo\Wewoshop\Domain\Model\Orders> $orders
	 */
	public function getOrders() {
		return $this->orders;
	}

	/**
	 * Sets the orders
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wewo\Wewoshop\Domain\Model\Orders> $orders
	 * @return void
	 */
	public function setOrders(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $orders) {
		$this->orders = $orders;
	}

	/**
	 * Returns the paymentMethodId
	 *
	 * @return \integer $paymentMethodId
	 */
	public function getPaymentMethodId() {
		return $this->paymentMethodId;
	}

	/**
	 * Sets the paymentMethodId
	 *
	 * @param \integer $paymentMethodId
	 * @return void
	 */
	public function setPaymentMethodId($paymentMethodId) {
		$this->paymentMethodId = $paymentMethodId;
	}

	/**
	 * Returns the iban
	 *
	 * @return string $iban
	 */
	public function getIban() {
		
		return $this->iban;
	}

	/**
	 * Sets the iban
	 *
	 * @param string $iban
	 * @return void
	 */
	public function setIban($iban) {
		
		$this->iban = $iban;
	}

	/**
	 * Returns the bic
	 *
	 * @return string $bic
	 */
	public function getBic() {
		
		return $this->bic;
	}

	/**
	 * Sets the bic
	 *
	 * @param string $bic
	 * @return void
	 */
	public function setBic($bic) {
		
		$this->bic = $bic;
	}

}
?>