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
class OrdersRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Search the table orders for the max order number.
	 * If it exists return this number + 1, else return 1.
	 *
	 * @return integer The new order number.
	 */
	public function generateOrderNumber() {
		        $query = $this->createQuery();
		        $query->getQuerySettings()->setReturnRawQueryResult(TRUE);
		        $query->statement('SELECT max(order_nr) FROM tx_wewoshop_domain_model_orders');
		        $orderNr = $query->execute();
		        if(isset($orderNr)) {
		            foreach($orderNr as $arraykey => $arrayvalue) {
		                foreach($arrayvalue as $positionkey => $maxOrderNr ) {
		                    return $maxOrderNr + 1;
		                }
		            }
		        } else {
		            return 1;
		        }
	}

}
?>