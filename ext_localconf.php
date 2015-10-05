<?php
defined('TYPO3_MODE') or die();

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . '/Classes/vendor/autoload.php');

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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Causal\\Doodle\\Property\\TypeConverter\\PollConverter');
