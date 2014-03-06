<?php

namespace Wewo\Wewoshop\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Wewo\Wewoshop\Domain\Model\FrontendUser.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FrontendUserTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Wewo\Wewoshop\Domain\Model\FrontendUser
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Wewo\Wewoshop\Domain\Model\FrontendUser();
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPasswordReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPassword()
		);
	}

	/**
	 * @test
	 */
	public function setPasswordForStringSetsPassword() {
		$this->subject->setPassword('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'password',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDeliveryAddressesReturnsInitialValueForDeliveryAddress() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getDeliveryAddresses()
		);
	}

	/**
	 * @test
	 */
	public function setDeliveryAddressesForObjectStorageContainingDeliveryAddressSetsDeliveryAddresses() {
		$deliveryAddress = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();
		$objectStorageHoldingExactlyOneDeliveryAddresses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneDeliveryAddresses->attach($deliveryAddress);
		$this->subject->setDeliveryAddresses($objectStorageHoldingExactlyOneDeliveryAddresses);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneDeliveryAddresses,
			'deliveryAddresses',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addDeliveryAddressToObjectStorageHoldingDeliveryAddresses() {
		$deliveryAddress = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();
		$deliveryAddressesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$deliveryAddressesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($deliveryAddress));
		$this->inject($this->subject, 'deliveryAddresses', $deliveryAddressesObjectStorageMock);

		$this->subject->addDeliveryAddress($deliveryAddress);
	}

	/**
	 * @test
	 */
	public function removeDeliveryAddressFromObjectStorageHoldingDeliveryAddresses() {
		$deliveryAddress = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();
		$deliveryAddressesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$deliveryAddressesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($deliveryAddress));
		$this->inject($this->subject, 'deliveryAddresses', $deliveryAddressesObjectStorageMock);

		$this->subject->removeDeliveryAddress($deliveryAddress);

	}
}
