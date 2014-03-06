<?php
namespace Wewo\Wewoshop\Domain\Validator;

/**
 * Class FrontendUserValidator
 *
 * @package Wewo\Wewoshop\Domain\Validator
 */
class FrontendUserValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * frontendUserRepository
     *
     * @var \Wewo\Wewoshop\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $frontendUserRepository;

    /**
     * 1. Checks the password with the confirmation password. Must be TRUE
     * 2. Check, if new user already exists in fe_users
     *
     * @return bool|void
     */
    public function isValid($feUser) {
        if(! $feUser instanceof \Wewo\Wewoshop\Domain\Model\FrontendUser) {
            $this->addError('Überprüftes Objekt ist nicht vom Typ FeUser', 1385029001);
            return FALSE;
        }

        // Check, if password and confirmationpassword  are equal
        if($feUser->getPassword() !== $feUser->getConfirmationPassword()) {
            $this->addError('Passwort und Bestätigungspasswort stimmen nicht überein', 1385028836);
            return FALSE;
        }

        // Check, if new user already exists in fe_users
        $feUserFirstName = $this->frontendUserRepository->findOneByFirstName($feUser->getFirstName());
        $feUserLastName = $this->frontendUserRepository->findOneByLastName($feUser->getLastName());
        if (isset($feUserFirstName) && isset($feUserLastName)) {
            $this->addError('Der User existiert bereits in der Datenbank', 1385546798);
            return FALSE;
        }

        return TRUE;
    }
}