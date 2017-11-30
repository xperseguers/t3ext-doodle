<?php
defined('TYPO3_MODE') || die();

$boot = function ($_EXTKEY) {
    // Require 3rd-party libraries, in case TYPO3 does not run in composer mode
    $pharFileName = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('doodle') . 'Libraries/causal-doodle-client.phar';
    if (is_file($pharFileName)) {
        @include 'phar://' . $pharFileName . '/vendor/autoload.php';
    }

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Causal.' . $_EXTKEY,
        'Doodle',
        array(
            'Doodle' => 'index,show',
        ),
        // non-cacheable actions
        array(
            'Doodle' => 'index,show',
        )
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter(\Causal\Doodle\Property\TypeConverter\PollConverter::class);
};

$boot($_EXTKEY);
unset($boot);
