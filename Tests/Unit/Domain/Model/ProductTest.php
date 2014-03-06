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
 * Test case for class \Wewo\Wewoshop\Domain\Model\Product.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ProductTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Wewo\Wewoshop\Domain\Model\Product
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Wewo\Wewoshop\Domain\Model\Product();
	}

	public function tearDown() {
		unset($this->subject);
	}



	/**
	 * @test
	 */
	public function getProductTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getProductTitle()
		);
	}

	/**
	 * @test
	 */
	public function setProductTitleForStringSetsProductTitle() {
		$this->subject->setProductTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'productTitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSizeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSize()
		);
	}

	/**
	 * @test
	 */
	public function setSizeForStringSetsSize() {
		$this->subject->setSize('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'size',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getWeightReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getWeight()
		);
	}

	/**
	 * @test
	 */
	public function setWeightForStringSetsWeight() {
		$this->subject->setWeight('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'weight',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getColorReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getColor()
		);
	}

	/**
	 * @test
	 */
	public function setColorForStringSetsColor() {
		$this->subject->setColor('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'color',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTeaserTextReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTeaserText()
		);
	}

	/**
	 * @test
	 */
	public function setTeaserTextForStringSetsTeaserText() {
		$this->subject->setTeaserText('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'teaserText',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionTextReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescriptionText()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionTextForStringSetsDescriptionText() {
		$this->subject->setDescriptionText('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'descriptionText',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForFloatSetsPrice() {
		$this->subject->setPrice(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'price',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getProductImgBigReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getProductImgBig()
		);
	}

	/**
	 * @test
	 */
	public function setProductImgBigForStringSetsProductImgBig() {
		$this->subject->setProductImgBig('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'productImgBig',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProductImgSmallReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getProductImgSmall()
		);
	}

	/**
	 * @test
	 */
	public function setProductImgSmallForStringSetsProductImgSmall() {
		$this->subject->setProductImgSmall('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'productImgSmall',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoriesReturnsInitialValueForCategory() {
		$this->assertEquals(
			NULL,
			$this->subject->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function setCategoriesForCategorySetsCategories() {
		$categoriesFixture = new \Wewo\Wewoshop\Domain\Model\Category();
		$this->subject->setCategories($categoriesFixture);

		$this->assertAttributeEquals(
			$categoriesFixture,
			'categories',
			$this->subject
		);
	}
}
