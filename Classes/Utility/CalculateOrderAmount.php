<?php
namespace Wewo\Wewoshop\Utility;

/**
 * Class CalculateOrderAmount
 *
 */
class CalculateOrderAmount {

    /**
     * Adds the single order position amounts to a total order amount
     *
     * @param $sessionObject contains all products of the basket
     * @param float $totalAmount to initialize
     * @return float the total order amount
     */
    public static function addOrderPositionAmounts($sessionObject, $totalAmount = 0) {
        foreach ($sessionObject as $sessionKey => $sessionValue) {
            foreach ($sessionValue as $productKey => $productValue) {
                if ($productKey === "Positionsbetrag") {
                    $totalAmount += $productValue;
                }
            }
        }
        return $totalAmount;
    }
}
