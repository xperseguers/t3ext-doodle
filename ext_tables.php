<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Doodle',
    'Doodle - List of polls'
);

// Register the FlexForms
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_doodle'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $_EXTKEY . '_doodle',
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_doodle.xml'
);

// Register the static TypoScript
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Doodle');

// Hook into "Flush general caches"
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] = 'Causal\\Doodle\\Hooks\\DataHandler->clearCacheCmd';
