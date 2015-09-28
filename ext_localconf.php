<?php
defined('TYPO3_MODE') or die();

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . '/Classes/vendor/autoload.php');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Causal.' . $_EXTKEY,
    'Doodle',
    array(
        'Doodle' => 'index',
    ),
    // non-cacheable actions
    array(
        'Doodle' => 'index',
    )
);
