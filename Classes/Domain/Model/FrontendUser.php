<?php
namespace Wewo\Wewoshop\Domain\Model;


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
//class FrontendUser extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
//class FrontendUser extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser {

/**
 * @package wewoshop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FrontendUser extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser {

	/**
	 * First name
	 *
	 * @var \string
	 */
	protected $firstName = '';

	/**
	 * Last name
	 *
	 * @var \string
	 */
	protected $lastName = '';

	/**
	 * Username
	 *
	 * @var \string
	 */
	protected $username = '';

	/**
	 * Address
	 *
	 * @var \string
	 */
	protected $address = '';

	/**
	 * Zip
	 *
	 * @var \string
	 */
	protected $zip = '';

	/**
	 * City
	 *
	 * @var \string
	 */
	protected $city = '';

	/**
	 * Terms
	 *
	 * @var \boolean
	 * @validate NotEmpty
	 * @validate \Wewo\Wewoshop\Domain\Validator\CheckTermsValidator
	 */
	protected $acceptTerms = FALSE;

	/**
	 * userGroup
	 *
	 * @var \integer
	 */
	protected $usergroup = 1;

	/**
	 * PID (= Storage Folder FE User)
	 *
	 * @var \integer
	 */
	protected $pid = 1;

	/**
	 * Accountnumber
	 *
	 * @var \integer
	 */
	protected $accountNr = '';

	/**
	 * Banknumber
	 *
	 * @var \integer
	 */
	protected $bankNr = '';

	/**
	 * Bankname
	 *
	 * @var \string
	 */
	protected $bankName = '';

	/**
	 * Confirmation Password
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $confirmationPassword = '';

	/**
	 * Email
	 *
	 * @var string
	 * @validate EmailAddress
	 */
	protected $email = '';

	/**
	 * Password
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $password = '';

	/**
	 * deliveryAddresses
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wewo\Wewoshop\Domain\Model\DeliveryAddress>
	 */
	protected $deliveryAddresses;

	/**
	 * Sets the firstName value
	 *
	 * @param string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		        $this->firstName = $firstName;
	}

	/**
	 * Sets the lastName value
	 *
	 * @param string $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		        $this->lastName = $lastName;
	}

	/**
	 * Sets the Username value
	 *
	 * @param string $userName
	 * @return void
	 */
	public function setUsername($username) {
		        $this->username = $username;
	}

	/**
	 * Sets the address value
	 *
	 * @param string $address
	 * @return void
	 */
	public function setAddress($address) {
		        $this->address = $address;
	}

	/**
	 * Sets the zip value
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		        $this->zip = $zip;
	}

	/**
	 * Sets the city value
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		        $this->city = $city;
	}

	/**
	 * Sets the email value
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		        $this->email = $email;
	}

	/**
	 * Sets the password value
	 *
	 * @param string $password
	 * @return void
	 */
	public function setPassword($password) {
		        $this->password = $password;
	}

	/**
	 * Sets the confirmation password value
	 *
	 * @param string $password
	 * @return void
	 */
	public function setConfirmationPassword($confirmationPassword) {
		        $this->confirmationPassword = $confirmationPassword;
	}

	/**
	 * Sets the terms value
	 *
	 * @param boolean $acceptTerms
	 * @return void
	 */
	public function setAcceptTerms($acceptTerms) {
		        $this->acceptTerms = $acceptTerms;
	}

	/**
	 * Sets the usergroups. Keep in mind that the property is called "usergroup"
	 * although it can hold several usergroups.
	 *
	 * @param integer $usergroup
	 * @return void
	 */
	public function setUsergroup($usergroup) {
		        $this->usergroup = $usergroup;
	}

	/**
	 * Sets the PID
	 *
	 * @param integer $pid
	 * @return void
	 */
	public function setPid($pid) {
		        $this->pid = $pid;
	}

	/**
	 * Sets the accountNumber
	 *
	 * @param integer $accountNr
	 * @return void
	 */
	public function setAccountNr($accountNr) {
		        $this->accountNr = $accountNr;
	}

	/**
	 * Sets the banknumber
	 *
	 * @param integer $bankNr
	 * @return void
	 */
	public function setBankNr($bankNr) {
		        $this->bankNr = $bankNr;
	}

	/**
	 * Sets the bankName
	 *
	 * @param string $bankName
	 * @return void
	 */
	public function setBankName($bankName) {
		        $this->bankName = $bankName;
	}

	/**
	 * Returns the firstName value
	 *
	 * @return string
	 */
	public function getFirstName() {
		    return $this->firstName;
	}

	/**
	 * Returns the lastName value
	 *
	 * @return string
	 */
	public function getLastName() {
		        return $this->lastName;
	}

	/**
	 * Returns the userName value
	 *
	 * @return string
	 */
	public function getUsername() {
		        return $this->username;
	}

	/**
	 * Returns the address value
	 *
	 * @return string
	 */
	public function getAddress() {
		        return $this->address;
	}

	/**
	 * Returns the zip value
	 *
	 * @return string
	 */
	public function getZip() {
		        return $this->zip;
	}

	/**
	 * Returns the city value
	 *
	 * @return string
	 */
	public function getCity() {
		        return $this->city;
	}

	/**
	 * Returns the email value
	 *
	 * @return string
	 */
	public function getEmail() {
		        return $this->email;
	}

	/**
	 * Returns the password value
	 *
	 * @return string
	 */
	public function getPassword() {
		        return $this->password;
	}

	/**
	 * Returns the confirmation password value
	 *
	 * @return string
	 */
	public function getConfirmationPassword() {
		        return $this->confirmationPassword;
	}

	/**
	 * Returns the terms value
	 *
	 * @return boolean
	 */
	public function getAcceptTerms() {
		        return $this->acceptTerms;
	}

	/**
	 * Returns the usergroups. Keep in mind that the property is called "usergroup"
	 * although it can hold several usergroups.
	 *
	 * @return integer
	 */
	public function getUsergroup() {
		        return $this->usergroup;
	}

	/**
	 * Returns the pid value
	 *
	 * @return integer
	 */
	public function getPid() {
		        return $this->pid;
	}

	/**
	 * Returns the accountnumber value
	 *
	 * @return integer
	 */
	public function getAccountNr() {
		        return $this->accountNr;
	}

	/**
	 * Returns the banknumber value
	 *
	 * @return integer
	 */
	public function getBankNr() {
		        return $this->bankNr;
	}

	/**
	 * Returns the bankname value
	 *
	 * @return string
	 */
	public function getBankName() {
		        return $this->bankName;
	}

	/**
	 * __construct
	 *
	 * @return FrontendUser
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
		$this->deliveryAddresses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a DeliveryAddress
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\DeliveryAddress $deliveryAddress
	 * @return void
	 */
	public function addDeliveryAddress(\Wewo\Wewoshop\Domain\Model\DeliveryAddress $deliveryAddress) {
		$this->deliveryAddresses->attach($deliveryAddress);
	}

	/**
	 * Removes a DeliveryAddress
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\DeliveryAddress $deliveryAddressToRemove The DeliveryAddress to be removed
	 * @return void
	 */
	public function removeDeliveryAddress(\Wewo\Wewoshop\Domain\Model\DeliveryAddress $deliveryAddressToRemove) {
		$this->deliveryAddresses->detach($deliveryAddressToRemove);
	}

	/**
	 * Returns the deliveryAddresses
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wewo\Wewoshop\Domain\Model\DeliveryAddress> $deliveryAddresses
	 */
	public function getDeliveryAddresses() {
		return $this->deliveryAddresses;
	}

	/**
	 * Sets the deliveryAddresses
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wewo\Wewoshop\Domain\Model\DeliveryAddress> $deliveryAddresses
	 * @return void
	 */
	public function setDeliveryAddresses(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $deliveryAddresses) {
		$this->deliveryAddresses = $deliveryAddresses;
	}

}

?>