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

namespace Causal\Doodle\Property\TypeConverter;

use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface;
use TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter;
use Causal\Doodle\Domain\Repository\PollRepository;
use Causal\Doodle\Utility\DoodleUtility;

/**
 * Class PollConverter
 *
 * @category    Property\TypeConverter
 * @package     doodle
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   2015-2017 Causal Sàrl
 * @license     https://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class PollConverter extends AbstractTypeConverter
{

    /**
     * @var array<string>
     */
    protected $sourceTypes = array('string');

    /**
     * Take precedence over the available other converters.
     *
     * @var int
     */
    protected $priority = 2;

    /**
     * @var string
     */
    protected $targetType = 'Causal\\DoodleClient\\Domain\\Model\\Poll';

    /**
     * Converts a poll id into an actual Poll object.
     *
     * @param string $source
     * @param string $targetType
     * @param array $convertedChildProperties
     * @param PropertyMappingConfigurationInterface|null $configuration
     * @return Poll
     */
    public function convertFrom($source, $targetType, array $convertedChildProperties = array(), PropertyMappingConfigurationInterface $configuration = null)
    {
        $pollRepository = DoodleUtility::initializePollRepository();
        $poll = $pollRepository->findById($source);

        return $poll;
    }

}
