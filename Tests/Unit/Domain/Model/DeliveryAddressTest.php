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
 * Test case for class \Wewo\Wewoshop\Domain\Model\DeliveryAddress.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DeliveryAddressTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Wewo\Wewoshop\Domain\Model\DeliveryAddress
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Wewo\Wewoshop\Domain\Model\DeliveryAddress();
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function getFirstNameDeliveryReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstNameDelivery()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameDeliveryForStringSetsFirstNameDelivery() {
		$this->subject->setFirstNameDelivery('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstNameDelivery',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastNameDeliveryReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastNameDelivery()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameDeliveryForStringSetsLastNameDelivery() {
		$this->subject->setLastNameDelivery('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastNameDelivery',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAddressDeliveryReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAddressDelivery()
		);
	}

	/**
	 * @test
	 */
	public function setAddressDeliveryForStringSetsAddressDelivery() {
		$this->subject->setAddressDelivery('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'addressDelivery',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipDeliveryReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getZipDelivery()
		);
	}

	/**
	 * @test
	 */
	public function setZipDeliveryForStringSetsZipDelivery() {
		$this->subject->setZipDelivery('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zipDelivery',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityDeliveryReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCityDelivery()
		);
	}

	/**
	 * @test
	 */
	public function setCityDeliveryForStringSetsCityDelivery() {
		$this->subject->setCityDelivery('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cityDelivery',
			$this->subject
		);
	}
}
