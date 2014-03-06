<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wewoshop_domain_model_payment'] = array(
	'ctrl' => $TCA['tx_wewoshop_domain_model_payment']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, payment_title, payment_method_id, debit_account_number, debit_bank_code, debit_bank_name, iban, bic, orders',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, payment_title, payment_method_id, debit_account_number, debit_bank_code, debit_bank_name, iban, bic, orders,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_wewoshop_domain_model_payment',
				'foreign_table_where' => 'AND tx_wewoshop_domain_model_payment.pid=###CURRENT_PID### AND tx_wewoshop_domain_model_payment.sys_language_uid IN (-1,0)',
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
		'payment_title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment.payment_title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'payment_method_id' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment.payment_method_id',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'debit_account_number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment.debit_account_number',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'debit_bank_code' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment.debit_bank_code',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'debit_bank_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment.debit_bank_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'iban' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment.iban',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bic' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment.bic',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'orders' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment.orders',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_wewoshop_domain_model_orders',
				'foreign_field' => 'payment',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
	),
);





## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>