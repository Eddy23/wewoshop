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
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Name of the product
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $productTitle;

	/**
	 * Size of the product
	 *
	 * @var string
	 */
	protected $size;

	/**
	 * Weight of the product
	 *
	 * @var string
	 */
	protected $weight;

	/**
	 * Color of the product
	 *
	 * @var string
	 */
	protected $color;

	/**
	 * Short Teaser of the product
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $teaserText;

	/**
	 * Description of the product
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $descriptionText;

	/**
	 * Price of the product
	 *
	 * @var float
	 * @validate NotEmpty
	 */
	protected $price;

	/**
	 * Big Image of the product
	 *
	 * @var string
	 */
	protected $productImgBig;

	/**
	 * Thumbnail of the product
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $productImgSmall;

	/**
	 * Category of the product
	 *
	 * @var \Wewo\Wewoshop\Domain\Model\Category
	 */
	protected $categories;

	/**
	 * Returns the size
	 *
	 * @return \string $size
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Sets the size
	 *
	 * @param \string $size
	 * @return void
	 */
	public function setSize($size) {
		$this->size = $size;
	}

	/**
	 * Returns the weight
	 *
	 * @return \string $weight
	 */
	public function getWeight() {
		return $this->weight;
	}

	/**
	 * Sets the weight
	 *
	 * @param \string $weight
	 * @return void
	 */
	public function setWeight($weight) {
		$this->weight = $weight;
	}

	/**
	 * Returns the color
	 *
	 * @return \string $color
	 */
	public function getColor() {
		return $this->color;
	}

	/**
	 * Sets the color
	 *
	 * @param \string $color
	 * @return void
	 */
	public function setColor($color) {
		$this->color = $color;
	}

	/**
	 * Returns the categories
	 *
	 * @return \Wewo\Wewoshop\Domain\Model\Category categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param \Wewo\Wewoshop\Domain\Model\Category $categories
	 * @return \Wewo\Wewoshop\Domain\Model\Category categories
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * Returns the productTitle
	 *
	 * @return \string productTitle
	 */
	public function getProductTitle() {
		return $this->productTitle;
	}

	/**
	 * Sets the productTitle
	 *
	 * @param \string $productTitle
	 * @return \string productTitle
	 */
	public function setProductTitle($productTitle) {
		$this->productTitle = $productTitle;
	}

	/**
	 * Returns the teaserText
	 *
	 * @return \string $teaserText
	 */
	public function getTeaserText() {
		return $this->teaserText;
	}

	/**
	 * Sets the teaserText
	 *
	 * @param \string $teaserText
	 * @return void
	 */
	public function setTeaserText($teaserText) {
		$this->teaserText = $teaserText;
	}

	/**
	 * Returns the descriptionText
	 *
	 * @return \string $descriptionText
	 */
	public function getDescriptionText() {
		return $this->descriptionText;
	}

	/**
	 * Sets the descriptionText
	 *
	 * @param \string $descriptionText
	 * @return void
	 */
	public function setDescriptionText($descriptionText) {
		$this->descriptionText = $descriptionText;
	}

	/**
	 * Returns the price
	 *
	 * @return \float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param \float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Returns the productImgBig
	 *
	 * @return \string $productImgBig
	 */
	public function getProductImgBig() {
		return $this->productImgBig;
	}

	/**
	 * Sets the productImgBig
	 *
	 * @param \string $productImgBig
	 * @return void
	 */
	public function setProductImgBig($productImgBig) {
		$this->productImgBig = $productImgBig;
	}

	/**
	 * Returns the productImgSmall
	 *
	 * @return \string $productImgSmall
	 */
	public function getProductImgSmall() {
		return $this->productImgSmall;
	}

	/**
	 * Sets the productImgSmall
	 *
	 * @param \string $productImgSmall
	 * @return void
	 */
	public function setProductImgSmall($productImgSmall) {
		$this->productImgSmall = $productImgSmall;
	}

}
?>