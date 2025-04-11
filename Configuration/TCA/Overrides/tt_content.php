<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addStaticFile(
    'ke_search',
    'Configuration/TypoScript',
    'Faceted Search'
);

// Add plugin group
ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'ke_search',
    'LLL:EXT:ke_search/Resources/Private/Language/locallang_mod.xlf:mlang_tabs_tab',
);

// Add plugins
ExtensionManagementUtility::addPlugin(
    [
        'label' => 'LLL:EXT:ke_search/Resources/Private/Language/locallang_searchbox.xlf:pi_title',
        'description' => 'LLL:EXT:ke_search/Resources/Private/Language/locallang_searchbox.xlf:pi_plus_wiz_description',
        'value' => 'ke_search_pi1',
        'icon'  => 'ext-kesearch-wizard-icon',
        'group' => 'ke_search',
    ],
    'CType',
    'ke_search'
);

ExtensionManagementUtility::addPlugin(
    [
        'label' => 'LLL:EXT:ke_search/Resources/Private/Language/locallang_resultlist.xlf:pi_title',
        'description' => 'LLL:EXT:ke_search/Resources/Private/Language/locallang_resultlist.xlf:pi_plus_wiz_description',
        'value' => 'ke_search_pi2',
        'icon'  => 'ext-kesearch-wizard-icon',
        'group' => 'ke_search',
    ],
    'CType',
    'ke_search'
);

ExtensionManagementUtility::addPlugin(
    [
        'label' => 'LLL:EXT:ke_search/Resources/Private/Language/locallang_searchbox.xlf:pi_cachable_title',
        'description' => 'LLL:EXT:ke_search/Resources/Private/Language/locallang_searchbox.xlf:pi_cachable_plus_wiz_description',
        'value' => 'ke_search_pi3',
        'icon'  => 'ext-kesearch-wizard-icon',
        'group' => 'ke_search',
    ],
    'CType',
    'ke_search'
);

// Configure FlexForm fields
$pluginFlexFormConfigs = [
    'ke_search_pi1' => 'FILE:EXT:ke_search/Configuration/FlexForms/flexform_searchbox.xml',
    'ke_search_pi2' => 'FILE:EXT:ke_search/Configuration/FlexForms/flexform_resultlist.xml',
    'ke_search_pi3' => 'FILE:EXT:ke_search/Configuration/FlexForms/flexform_searchbox.xml',
];
foreach ($pluginFlexFormConfigs as $pluginName => $flexFormFile) {
    ExtensionManagementUtility::addPiFlexFormValue('*', $flexFormFile, $pluginName);
    $GLOBALS['TCA']['tt_content']['types'][$pluginName]['showitem'] = '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
            pi_flexform,'
        . ($pluginName != 'ke_search_pi2' ? 'pages, recursive,' : '')
        . '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
            --palette--;;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ';
}
