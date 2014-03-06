<?php
/**
 * Created by JetBrains PhpStorm.
 * User: etti
 * Date: 16.05.13
 * Time: 16:47
 * To change this template use File | Settings | File Templates.
 */

namespace Wewo\Wewoshop\Domain\Session;

class SessionHandler implements \TYPO3\CMS\Core\SingletonInterface  {

    /**
     * Returns the object stored in the user´s PHP session
     * @return Object the stored object
     */
    public function restoreFromSession() {
        $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_wewoshop_pi1');
        return unserialize($sessionData);
    }

    /**
     * Writes an object into the PHP session
     * @param	$object	any serializable object to store into the session
     * @return	\Wewo\Wewoshop\Domain\Session\SessionHandler this
     */
    public function writeToSession($object) {
        $sessionData = serialize($object);
        $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_wewoshop_pi1', $sessionData);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
        return $this;
    }

    /**
     * Cleans up the session: removes the stored object from the PHP session
     * @return	\Wewo\Wewoshop\Domain\Session\SessionHandler this
     */
    public function cleanUpSession() {
        $GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_wewoshop_pi1', NULL);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
        return $this;
    }
}
?>