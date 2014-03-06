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
class DeliveryAddress extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * firstNameDelivery
	 *
	 * @var string
	 */
	protected $firstNameDelivery;

	/**
	 * lastNameDelivery
	 *
	 * @var string
	 */
	protected $lastNameDelivery;

	/**
	 * addressDelivery
	 *
	 * @var string
	 */
	protected $addressDelivery;

	/**
	 * zipDelivery
	 *
	 * @var string
	 */
	protected $zipDelivery;

	/**
	 * cityDelivery
	 *
	 * @var string
	 */
	protected $cityDelivery;

	/**
	 * Returns the firstNameDelivery
	 *
	 * @return \string $firstNameDelivery
	 */
	public function getFirstNameDelivery() {
		return $this->firstNameDelivery;
	}

	/**
	 * Sets the firstNameDelivery
	 *
	 * @param \string $firstNameDelivery
	 * @return void
	 */
	public function setFirstNameDelivery($firstNameDelivery) {
		$this->firstNameDelivery = $firstNameDelivery;
	}

	/**
	 * Returns the lastNameDelivery
	 *
	 * @return \string $lastNameDelivery
	 */
	public function getLastNameDelivery() {
		return $this->lastNameDelivery;
	}

	/**
	 * Sets the lastNameDelivery
	 *
	 * @param \string $lastNameDelivery
	 * @return void
	 */
	public function setLastNameDelivery($lastNameDelivery) {
		$this->lastNameDelivery = $lastNameDelivery;
	}

	/**
	 * Returns the addressDelivery
	 *
	 * @return \string $addressDelivery
	 */
	public function getAddressDelivery() {
		return $this->addressDelivery;
	}

	/**
	 * Sets the addressDelivery
	 *
	 * @param \string $addressDelivery
	 * @return void
	 */
	public function setAddressDelivery($addressDelivery) {
		$this->addressDelivery = $addressDelivery;
	}

	/**
	 * Returns the zipDelivery
	 *
	 * @return \string $zipDelivery
	 */
	public function getZipDelivery() {
		return $this->zipDelivery;
	}

	/**
	 * Sets the zipDelivery
	 *
	 * @param \string $zipDelivery
	 * @return void
	 */
	public function setZipDelivery($zipDelivery) {
		$this->zipDelivery = $zipDelivery;
	}

	/**
	 * Returns the cityDelivery
	 *
	 * @return \string $cityDelivery
	 */
	public function getCityDelivery() {
		return $this->cityDelivery;
	}

	/**
	 * Sets the cityDelivery
	 *
	 * @param \string $cityDelivery
	 * @return void
	 */
	public function setCityDelivery($cityDelivery) {
		$this->cityDelivery = $cityDelivery;
	}

}
?>