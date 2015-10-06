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

namespace Causal\Doodle\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class PollRepository
 *
 * @category    Domain\Repository
 * @package     doodle
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   2015 Causal Sàrl
 * @license     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class PollRepository
{

    /**
     * @var \Causal\DoodleClient\Client
     */
    protected $doodleClient;

    /**
     * Sets the doodle client.
     *
     * @param \Causal\DoodleClient\Client $doodleClient
     * @return void
     */
    public function setDoodleClient(\Causal\DoodleClient\Client $doodleClient)
    {
        $this->doodleClient = $doodleClient;
    }

    /**
     * Finds all personal polls.
     *
     * @return \Causal\DoodleClient\Domain\Model\Poll[]
     */
    public function findAll()
    {
        static $polls = null;
        if ($polls === null) {
            $polls = $this->doodleClient->getPersonalPolls();
        }
        return $polls;
    }

    /**
     * Finds a personal poll by its id.
     *
     * @param string $id
     * @return \Causal\DoodleClient\Domain\Model\Poll
     */
    public function findById($id)
    {
        // TODO: This may certainly be optimized by extending the client to fetch a single poll
        $polls = $this->findAll();
        foreach ($polls as $poll) {
            if ($poll->getId() === $id) {
                return $poll;
            }
        }
        return null;
    }

    /**
     * Returns personal polls filtered by state.
     *
     * @param string $state One of the \Causal\DoodleClient\Domain\Model\Poll::STATE_* constants
     * @return \Causal\DoodleClient\Domain\Model\Poll[]
     */
    public function findByState($state)
    {
        $polls = $this->findAll();
        $filteredPolls = array();
        foreach ($polls as $poll) {
            if ($poll->getState() === $state) {
                $filteredPolls[] = $poll;
            }
        }
        return $filteredPolls;
    }

    /**
     * Filters polls by a given prefix in their title.
     *
     * @param \Causal\DoodleClient\Domain\Model\Poll[] $polls
     * @param string $prefix
     * @return \Causal\DoodleClient\Domain\Model\Poll[]
     */
    public function filterByPrefixInTitle(array $polls, $prefix)
    {
        $filteredPolls = array();
        foreach ($polls as $poll) {
            if (GeneralUtility::isFirstPartOfStr($poll->getTitle(), $prefix)) {
                $filteredPolls[] = $poll;
            }
        }
        return $filteredPolls;
    }

}
