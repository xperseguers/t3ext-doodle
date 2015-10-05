<?php
namespace Causal\Doodle\Controller;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Causal\Doodle\Domain\Repository\PollRepository;
use Causal\Doodle\Utility\DoodleUtility;
use Causal\DoodleClient\Domain\Model\Poll;

/**
 * Doodle controller.
 *
 * @category    Controller
 * @package     doodle
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   2015 Causal Sàrl
 * @license     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class DoodleController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    const MODE_ALL = 'ALL';
    const MODE_ACTIVE = 'ACTIVE';
    const MODE_INACTIVE = 'INACTIVE';

    /**
     * @var PollRepository
     */
    protected $pollRepository;

    /**
     * Injects a poll repository.
     *
     * @return void
     */
    public function initializeAction()
    {
        $this->pollRepository = DoodleUtility::initializePollRepository();
    }

    /**
     * Index action.
     *
     * @return string
     */
    public function indexAction()
    {
        $activePolls = $this->settings['mode'] === static::MODE_ALL || $this->settings['mode'] === static::MODE_ACTIVE
            ? $this->pollRepository->findByState(Poll::STATE_OPEN)
            : array();
        $inactivePolls = $this->settings['mode'] === static::MODE_ALL || $this->settings['mode'] === static::MODE_INACTIVE
            ? $this->pollRepository->findByState(Poll::STATE_CLOSED)
            : array();

        if (!empty($this->settings['prefixTitle'])) {
            $activePolls = $this->pollRepository->filterByPrefixInTitle($activePolls, $this->settings['prefixTitle']);
            $inactivePolls = $this->pollRepository->filterByPrefixInTitle($inactivePolls, $this->settings['prefixTitle']);
        }

        $this->view->assignMultiple(array(
            'activePolls' => $activePolls,
            'inactivePolls' => $inactivePolls,
        ));
    }

    /**
     * Shows a single poll.
     *
     * @param Poll $poll
     * @return void
     */
    public function showAction(Poll $poll)
    {
        $this->view->assign('poll', $poll);
    }

}
