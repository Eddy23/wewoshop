<?php
namespace Wewo\Wewoshop\Domain\Validator;

/**
 * Class BasketQuantityValidator
 *
 * @package Wewo\Wewoshop\Domain\Validator
 */
class BasketQuantityValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * Checks the given value. Must be integer and greater than 0
     *
     * @param mixed $value The value that should be validated
     * @return bool|void
     */
    public function isValid($value) {
        // Ist $value ein Integer und größer 0
         if (filter_var($value, FILTER_VALIDATE_INT) !== FALSE && $value > 0) {
            return TRUE;
        } else {
             // Fehlermeldung kann durch de.locallang.xlf überschrieben werden
             $this->addError('Bitte geben Sie einen Zahlenwert größer als Null ein', 1231231231);
             return FALSE;
        }
    }
}