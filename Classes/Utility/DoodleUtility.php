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

namespace Causal\Doodle\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Causal\Doodle\Domain\Repository\PollRepository;

/**
 * Class DoodleUtility
 *
 * @category    Utility
 * @package     doodle
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   2015-2017 Causal Sàrl
 * @license     https://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class DoodleUtility
{

    /**
     * Initializes a poll repository.
     *
     * @return PollRepository
     */
    public static function initializePollRepository()
    {
        $settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['doodle']);
        /** @var \Causal\DoodleClient\Client $doodleClient */
        $doodleClient = GeneralUtility::makeInstance('Causal\\DoodleClient\\Client', $settings['username'], $settings['password']);
        $cookiePath = PATH_site . 'typo3temp/tx_doodle/';
        if (!is_dir($cookiePath)) {
            GeneralUtility::mkdir($cookiePath);
        }
        if (!is_file($cookiePath . '/.htaccess')) {
            GeneralUtility::writeFile($cookiePath . '/.htaccess', 'Deny from all');
        }
        $doodleClient
            ->setCookiePath($cookiePath)
            ->connect();

        /** @var \Causal\Doodle\Domain\Repository\PollRepository $pollRepository */
        $pollRepository = GeneralUtility::makeInstance('Causal\\Doodle\\Domain\\Repository\\PollRepository');
        $pollRepository->setDoodleClient($doodleClient);

        return $pollRepository;
    }

}
