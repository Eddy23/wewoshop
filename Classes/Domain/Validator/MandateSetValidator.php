<?php
namespace Wewo\Wewoshop\Domain\Validator;

/**
 * Class MandateSetValidator
 *
 * @package Wewo\Wewoshop\Domain\Validator
 */
class MandateSetValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * Checks the given value. Must be integer and 1
     *
     * @param mixed $value The value that should be validated
     * @return bool|void
     */
    public function isValid($value) {
        // Ist $value ein Integer und größer 0
         if (filter_var($value, FILTER_VALIDATE_INT) !== FALSE && $value == 1) {
            return TRUE;
        } else {
             // Fehlermeldung kann durch de.locallang.xlf überschrieben werden
             $this->addError('Bitte kreuzen Sie das Feld zur Erteilung des Mandates an', 1395768815);
             return FALSE;
        }
    }
}