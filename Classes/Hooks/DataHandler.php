<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with TYPO3 source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Causal\Doodle\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class DataHandler
 *
 * @category    Hooks
 * @package     doodle
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   2015-2016 Causal Sàrl
 * @license     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class DataHandler
{

    /**
     * Disconnects from Doodle by removing all stored cookies whenever
     * TYPO3 administrator flushes all "general" caches.
     *
     * @param array $parameters
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $pObj
     * @return void
     */
    public function clearCacheCmd(array $parameters, \TYPO3\CMS\Core\DataHandling\DataHandler $pObj)
    {
        if ($parameters['cacheCmd'] !== 'all') {
            return;
        }

        $cookiePath = PATH_site . 'typo3temp/tx_doodle/';
        if (is_dir($cookiePath)) {
            $cookies = GeneralUtility::getFilesInDir($cookiePath);
            foreach ($cookies as $cookie) {
                if (preg_match('/^[0-9a-f]{40}$/', $cookie)) {
                    @unlink($cookiePath . $cookie);
                }
            }
        }
    }

}
