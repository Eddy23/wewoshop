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
class Orders extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Number of the order
	 *
	 * @var integer
	 */
	protected $orderNr = 0;

	/**
	 * Number ot the position of one product in the order
	 *
	 * @var integer
	 */
	protected $orderPositionNr;

	/**
	 * Quantity of a single orderposition
	 *
	 * @var integer
	 */
	protected $orderPositionVolume = 0;

	/**
	 * UID of the product
	 *
	 * @var integer
	 */
	protected $productUid = 0;

	/**
	 * UID of the feUser
	 *
	 * @var integer
	 */
	protected $feUserUid = 0;

	/**
	 * Number ot the paymentmethod
	 *
	 * @var integer
	 */
	protected $paymentMethod = 0;

	/**
	 * Returns the orderNr
	 *
	 * @return \integer $orderNr
	 */
	public function getOrderNr() {
		return $this->orderNr;
	}

	/**
	 * Sets the orderNr
	 *
	 * @param \integer $orderNr
	 * @return void
	 */
	public function setOrderNr($orderNr) {
		$this->orderNr = $orderNr;
	}

	/**
	 * Returns the orderPositionVolume
	 *
	 * @return \integer $orderPositionVolume
	 */
	public function getOrderPositionVolume() {
		return $this->orderPositionVolume;
	}

	/**
	 * Sets the orderPositionVolume
	 *
	 * @param \integer $orderPositionVolume
	 * @return void
	 */
	public function setOrderPositionVolume($orderPositionVolume) {
		$this->orderPositionVolume = $orderPositionVolume;
	}

	/**
	 * Returns the productUid
	 *
	 * @return \integer $productUid
	 */
	public function getProductUid() {
		return $this->productUid;
	}

	/**
	 * Sets the productUid
	 *
	 * @param \integer $productUid
	 * @return void
	 */
	public function setProductUid($productUid) {
		$this->productUid = $productUid;
	}

	/**
	 * Returns the feUserUid
	 *
	 * @return \integer $feUserUid
	 */
	public function getFeUserUid() {
		return $this->feUserUid;
	}

	/**
	 * Sets the feUserUid
	 *
	 * @param \integer $feUserUid
	 * @return void
	 */
	public function setFeUserUid($feUserUid) {
		$this->feUserUid = $feUserUid;
	}

	/**
	 * Returns the paymentMethod
	 *
	 * @return \integer $paymentMethod
	 */
	public function getPaymentMethod() {
		return $this->paymentMethod;
	}

	/**
	 * Sets the paymentMethod
	 *
	 * @param \integer $paymentMethod
	 * @return void
	 */
	public function setPaymentMethod($paymentMethod) {
		$this->paymentMethod = $paymentMethod;
	}

	/**
	 * Returns the orderPositionNr
	 *
	 * @return \integer $orderPositionNr
	 */
	public function getOrderPositionNr() {
		return $this->orderPositionNr;
	}

	/**
	 * Sets the orderPositionNr
	 *
	 * @param \integer $orderPositionNr
	 * @return void
	 */
	public function setOrderPositionNr($orderPositionNr) {
		$this->orderPositionNr = $orderPositionNr;
	}

	/**
	 * __construct
	 *
	 * @return Orders
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
		// empty
	}

}
?>