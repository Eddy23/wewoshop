<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wewoshop_domain_model_orders'] = array(
	'ctrl' => $TCA['tx_wewoshop_domain_model_orders']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, order_nr, order_position_nr, order_position_volume, product_uid, fe_user_uid, payment_method, mandate, mandate_reference',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, order_nr, order_position_nr, order_position_volume, product_uid, fe_user_uid, payment_method, mandate, mandate_reference,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_wewoshop_domain_model_orders',
				'foreign_table_where' => 'AND tx_wewoshop_domain_model_orders.pid=###CURRENT_PID### AND tx_wewoshop_domain_model_orders.sys_language_uid IN (-1,0)',
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
		'order_nr' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders.order_nr',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'order_position_nr' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders.order_position_nr',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'order_position_volume' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders.order_position_volume',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'product_uid' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders.product_uid',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'fe_user_uid' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders.fe_user_uid',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'payment_method' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders.payment_method',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'mandate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders.mandate',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'mandate_reference' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders.mandate_reference',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'payment' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
        'crdate' => array(
            'exclude' => 1,
            'label' => 'Creation date',
            'config' => array(
                    'type' => 'none',
                    'format' => 'datetime',
                    'eval' => 'datetime',
            )
        ),
    ),
);





## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>