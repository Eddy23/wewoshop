<?php
namespace Wewo\Wewoshop\Domain\Repository;


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
class ProductRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Finds an object by categorie matching the given identifier.
	 *
	 * @param integer $category The identifier of the object to find
	 * @return object The matching object if found, otherwise NULL
	 */
	public function findByCategory($category) {
		        if ($this->identityMap->hasIdentifier($category, $this->objectType)) {
		            $object = $this->identityMap->getObjectByIdentifier($category, $this->objectType);
		        } else {
		            $query = $this->createQuery();
		            $query->getQuerySettings()->setRespectSysLanguage(FALSE);
		            $query->getQuerySettings()->setRespectStoragePage(FALSE);
		            $object = $query->matching($query->equals('categories', $category))->execute();
		        }
		        return $object;
	}

	/**
	 * Finds objects by product_title matching the given identifier.
	 *
	 * @param string $searchQuery The identifier of the object to find
	 * @return object The matching objects if found, otherwise NULL
	 */
	public function findByTitle($searchQuery) {
		        if ($this->identityMap->hasIdentifier($searchQuery, $this->objectType)) {
		            $object = $this->identityMap->getObjectByIdentifier($searchQuery, $this->objectType);
		        } else {
		            $query = $this->createQuery();
		            $query->getQuerySettings()->setRespectSysLanguage(FALSE);
		            $query->getQuerySettings()->setRespectStoragePage(FALSE);
		            // Suchstring kann überall im Wort vorkommen, daher den String wrappen mit %
		            $searchQuery = '%'.$searchQuery.'%';
		            $object = $query->matching($query->like('product_title', $searchQuery))->execute();
		        }
		        return $object;
	}

}
?>