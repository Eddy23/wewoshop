<?php
/**
 * Created by JetBrains PhpStorm.
 * User: etti
 * Date: 16.05.13
 * Time: 17:06
 * To change this template use File | Settings | File Templates.
 */

namespace Wewo\Wewoshop\Domain\Repository;


class ObjectRepository extends \TYPO3\CMS\Extbase\Persistence\Repository{

    /**
     * The session handler
     * @var \Wewo\Wewoshop\Domain\Session\SessionHandler
     * @inject
     */
    protected $sessionHandler = NULL;

/*
    public function __construct() {
        parent::__construct();
        // get an instance of the session handler
        $this->sessionHandler = t3lib_div::makeInstance('Tx_MyExt_Domain_Session_SessionHandler');
    }
*/

    /**
     * Inject the session handler
     *
     * @param \Wewo\Wewoshop\Domain\Session $sessionHandler
     * @return void
     */
/*
    public function injectSessionHandler(\Wewo\Wewoshop\Domain\Session $sessionHandler) {
        $this->sessionHandler = $sessionHandler;
    }
*/

    /**
     * Returns the object stored in the user´s PHP session
     *
     * @return the stored Object
     */
    public function findBySession() {
        return $this->sessionHandler->restoreFromSession();
    }

    /**
     * Writes the object into the PHP session
     *
     * @param	$object	any serializable object to store into the session
     * @return	\Wewo\Wewoshop\Domain\Repository\ObjectRepository this
     */
    public function writeToSession($object) {
        $this->sessionHandler->writeToSession($object);
        return $this;
    }

    /**
     * Cleans up the session: removes the stored object from the PHP session
     *
     * @return	\Wewo\Wewoshop\Domain\Repository\ObjectRepository this
     */
    public function cleanUpSession() {
        $this->sessionHandler->cleanUpSession();
        return $this;
    }
}
?>