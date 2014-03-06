<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wewoshop_domain_model_deliveryaddress'] = array(
	'ctrl' => $TCA['tx_wewoshop_domain_model_deliveryaddress']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name_delivery, last_name_delivery, address_delivery, zip_delivery, city_delivery',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, first_name_delivery, last_name_delivery, address_delivery, zip_delivery, city_delivery,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wewoshop_domain_model_deliveryaddress',
				'foreign_table_where' => 'AND tx_wewoshop_domain_model_deliveryaddress.pid=###CURRENT_PID### AND tx_wewoshop_domain_model_deliveryaddress.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		
		
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'first_name_delivery' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_deliveryaddress.first_name_delivery',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'last_name_delivery' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_deliveryaddress.last_name_delivery',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'address_delivery' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_deliveryaddress.address_delivery',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip_delivery' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_deliveryaddress.zip_delivery',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city_delivery' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_deliveryaddress.city_delivery',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'frontenduser' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);





## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>