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
 * Test case for class \Wewo\Wewoshop\Domain\Model\Payment.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class PaymentTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Wewo\Wewoshop\Domain\Model\Payment
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Wewo\Wewoshop\Domain\Model\Payment();
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function getPaymentTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPaymentTitle()
		);
	}

	/**
	 * @test
	 */
	public function setPaymentTitleForStringSetsPaymentTitle() {
		$this->subject->setPaymentTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'paymentTitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPaymentMethodIdReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getPaymentMethodId()
		);
	}

	/**
	 * @test
	 */
	public function setPaymentMethodIdForIntegerSetsPaymentMethodId() {
		$this->subject->setPaymentMethodId(12);

		$this->assertAttributeEquals(
			12,
			'paymentMethodId',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDebitAccountNumberReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDebitAccountNumber()
		);
	}

	/**
	 * @test
	 */
	public function setDebitAccountNumberForStringSetsDebitAccountNumber() {
		$this->subject->setDebitAccountNumber('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'debitAccountNumber',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDebitBankCodeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDebitBankCode()
		);
	}

	/**
	 * @test
	 */
	public function setDebitBankCodeForStringSetsDebitBankCode() {
		$this->subject->setDebitBankCode('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'debitBankCode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDebitBankNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDebitBankName()
		);
	}

	/**
	 * @test
	 */
	public function setDebitBankNameForStringSetsDebitBankName() {
		$this->subject->setDebitBankName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'debitBankName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIbanReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getIban()
		);
	}

	/**
	 * @test
	 */
	public function setIbanForStringSetsIban() {
		$this->subject->setIban('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'iban',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBicReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getBic()
		);
	}

	/**
	 * @test
	 */
	public function setBicForStringSetsBic() {
		$this->subject->setBic('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'bic',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOrdersReturnsInitialValueForOrders() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getOrders()
		);
	}

	/**
	 * @test
	 */
	public function setOrdersForObjectStorageContainingOrdersSetsOrders() {
		$order = new \Wewo\Wewoshop\Domain\Model\Orders();
		$objectStorageHoldingExactlyOneOrders = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneOrders->attach($order);
		$this->subject->setOrders($objectStorageHoldingExactlyOneOrders);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneOrders,
			'orders',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addOrderToObjectStorageHoldingOrders() {
		$order = new \Wewo\Wewoshop\Domain\Model\Orders();
		$ordersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$ordersObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($order));
		$this->inject($this->subject, 'orders', $ordersObjectStorageMock);

		$this->subject->addOrder($order);
	}

	/**
	 * @test
	 */
	public function removeOrderFromObjectStorageHoldingOrders() {
		$order = new \Wewo\Wewoshop\Domain\Model\Orders();
		$ordersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$ordersObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($order));
		$this->inject($this->subject, 'orders', $ordersObjectStorageMock);

		$this->subject->removeOrder($order);

	}
}
