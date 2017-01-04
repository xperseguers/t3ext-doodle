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

namespace Causal\Doodle\ViewHelpers\Format;

/**
 * Class SubstringViewHelper
 *
 * @category    ViewHelpers\Format
 * @package     doodle
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   2015-2017 Causal Sàrl
 * @license     https://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class SubstringViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Returns part of a string.
     *
     * @param string $string
     * @param mixed $start
     * @param int $length
     * @return string
     */
    public function render($string = null, $start = 0, $length = null)
    {
        if ($string === null) {
            $string = $this->renderChildren();
        }
        if (!is_int($start)) {
            $start = strlen($start);
        }
        return $length !== null
            ? substr($string, $start, $length)
            : substr($string, $start);
    }

}
