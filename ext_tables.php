<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\R3H6\Error404page\Utility\CustomPageUtility::addDoktype(
    $_EXTKEY,
    \R3H6\Error404page\Configuration\ExtensionConfiguration::doktypeError404page(),
    'Error404page'
);
if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'R3H6.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'log',	// Submodule key
		'',						// Position
		array(
			'Error' => 'index, list, deleteAll, chart',

		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_log.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Error 404 page');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_error404page_domain_model_error', 'EXT:error404page/Resources/Private/Language/locallang_csh_tx_error404page_domain_model_error.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_error404page_domain_model_error');
