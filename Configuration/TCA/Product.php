<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wewoshop_domain_model_product'] = array(
	'ctrl' => $TCA['tx_wewoshop_domain_model_product']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, product_title, size, weight, color, teaser_text, description_text, price, product_img_big, product_img_small, categories',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, product_title, size, weight, color, teaser_text, description_text, price, product_img_big, product_img_small, categories,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_wewoshop_domain_model_product',
				'foreign_table_where' => 'AND tx_wewoshop_domain_model_product.pid=###CURRENT_PID### AND tx_wewoshop_domain_model_product.sys_language_uid IN (-1,0)',
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
		'product_title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.product_title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'size' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.size',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'weight' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.weight',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'color' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.color',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'teaser_text' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.teaser_text',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required'
			),
		),
		'description_text' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.description_text',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required'
			),
		),
		'price' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.price',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2,required'
			),
		),
		'product_img_big' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.product_img_big',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_wewoshop',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		'product_img_small' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.product_img_small',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_wewoshop',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		'categories' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product.categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_wewoshop_domain_model_category',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
	),
);





## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>