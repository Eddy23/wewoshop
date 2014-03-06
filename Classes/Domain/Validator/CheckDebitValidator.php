<?php
namespace Wewo\Wewoshop\Domain\Validator;

/**
 * Class CheckDebitValidator
 *
 * @package Wewo\Wewoshop\Domain\Validator
 */
class CheckDebitValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * If debit is choose, the fields debitAccountNumber, debitBankCode and debitBankName must be filled
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValid($value) {
        if($value->getPaymentMethod() === 1) {
            if(($value->getDebitAccountNumber() !== '') && ($value->getDebitBankCode() !== '') && ($value->getDebitBankName() !== '')  ){
                return TRUE;
            } else {
                $this->addError('Es wurden nicht alle Felder der Kontoverbindung ausgefüllt', 99988877766);
                return FALSE;
            }
        }
    }
}