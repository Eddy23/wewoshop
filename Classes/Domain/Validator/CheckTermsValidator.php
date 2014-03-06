<?php
namespace Wewo\Wewoshop\Domain\Validator;

/**
 * Class CheckTermsValidator
 *
 * @package Wewo\Wewoshop\Domain\Validator
 */
class CheckTermsValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * Checks the given boolean value. Must be TRUE
     *
     * @param mixed $value The value that should be validated
     * @return bool|void
     */
    public function isValid($value) {
        // Ist $value ein Integer und größer 0
         if (filter_var($value, FILTER_VALIDATE_BOOLEAN) !== FALSE && $value == TRUE) {
            return TRUE;
        } else {
             // Fehlermeldung kann durch de.locallang.xlf überschrieben werden
             $this->addError('Die AGB und Datenschutzbestimmungen müssen akzeptiert werden', 1291291291);
             return FALSE;
        }
    }
}