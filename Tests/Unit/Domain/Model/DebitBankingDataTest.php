<?php

namespace Wewo\Wewoshop\Tests;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
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
 * Test case for class \Wewo\Wewoshop\Domain\Model\DebitBankingData.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Wewo Shop
 *
 */
class DebitBankingDataTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Wewo\Wewoshop\Domain\Model\DebitBankingData
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Wewo\Wewoshop\Domain\Model\DebitBankingData();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getDebitAccountNumberReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDebitAccountNumberForStringSetsDebitAccountNumber() { 
		$this->fixture->setDebitAccountNumber('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDebitAccountNumber()
		);
	}
	
	/**
	 * @test
	 */
	public function getDebitBankCodeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDebitBankCodeForStringSetsDebitBankCode() { 
		$this->fixture->setDebitBankCode('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDebitBankCode()
		);
	}
	
	/**
	 * @test
	 */
	public function getDebitBankNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDebitBankNameForStringSetsDebitBankName() { 
		$this->fixture->setDebitBankName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDebitBankName()
		);
	}
	
}
?>