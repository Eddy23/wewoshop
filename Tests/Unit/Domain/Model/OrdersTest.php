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
 * Test case for class \Wewo\Wewoshop\Domain\Model\Orders.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class OrdersTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Wewo\Wewoshop\Domain\Model\Orders
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Wewo\Wewoshop\Domain\Model\Orders();
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function getOrderNrReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getOrderNr()
		);
	}

	/**
	 * @test
	 */
	public function setOrderNrForIntegerSetsOrderNr() {
		$this->subject->setOrderNr(12);

		$this->assertAttributeEquals(
			12,
			'orderNr',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOrderPositionNrReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getOrderPositionNr()
		);
	}

	/**
	 * @test
	 */
	public function setOrderPositionNrForIntegerSetsOrderPositionNr() {
		$this->subject->setOrderPositionNr(12);

		$this->assertAttributeEquals(
			12,
			'orderPositionNr',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOrderPositionVolumeReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getOrderPositionVolume()
		);
	}

	/**
	 * @test
	 */
	public function setOrderPositionVolumeForIntegerSetsOrderPositionVolume() {
		$this->subject->setOrderPositionVolume(12);

		$this->assertAttributeEquals(
			12,
			'orderPositionVolume',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProductUidReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getProductUid()
		);
	}

	/**
	 * @test
	 */
	public function setProductUidForIntegerSetsProductUid() {
		$this->subject->setProductUid(12);

		$this->assertAttributeEquals(
			12,
			'productUid',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFeUserUidReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getFeUserUid()
		);
	}

	/**
	 * @test
	 */
	public function setFeUserUidForIntegerSetsFeUserUid() {
		$this->subject->setFeUserUid(12);

		$this->assertAttributeEquals(
			12,
			'feUserUid',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPaymentMethodReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getPaymentMethod()
		);
	}

	/**
	 * @test
	 */
	public function setPaymentMethodForIntegerSetsPaymentMethod() {
		$this->subject->setPaymentMethod(12);

		$this->assertAttributeEquals(
			12,
			'paymentMethod',
			$this->subject
		);
	}
}
