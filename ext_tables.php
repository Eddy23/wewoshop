<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Wewoshopp1',
	'WewoFElist'
);



\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Wewo Shop');


	
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wewoshop_domain_model_category', 'EXT:wewoshop/Resources/Private/Language/locallang_csh_tx_wewoshop_domain_model_category.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wewoshop_domain_model_category');
$TCA['tx_wewoshop_domain_model_category'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_category',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wewoshop_domain_model_category.gif'
	),
);
	

	
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wewoshop_domain_model_product', 'EXT:wewoshop/Resources/Private/Language/locallang_csh_tx_wewoshop_domain_model_product.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wewoshop_domain_model_product');
$TCA['tx_wewoshop_domain_model_product'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_product',
		'label' => 'product_title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'product_title,size,weight,color,teaser_text,description_text,price,product_img_big,product_img_small,categories,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Product.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wewoshop_domain_model_product.gif'
	),
);
	

	
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wewoshop_domain_model_frontenduser', 'EXT:wewoshop/Resources/Private/Language/locallang_csh_tx_wewoshop_domain_model_frontenduser.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wewoshop_domain_model_frontenduser');
$TCA['tx_wewoshop_domain_model_frontenduser'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_frontenduser',
		'label' => 'email',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'email,password,delivery_addresses,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/FrontendUser.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wewoshop_domain_model_frontenduser.gif'
	),
);
	

	
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wewoshop_domain_model_frontenduserverify', 'EXT:wewoshop/Resources/Private/Language/locallang_csh_tx_wewoshop_domain_model_frontenduserverify.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wewoshop_domain_model_frontenduserverify');
$TCA['tx_wewoshop_domain_model_frontenduserverify'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_frontenduserverify',
		'label' => 'uid',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => '',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/FrontendUserVerify.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wewoshop_domain_model_frontenduserverify.gif'
	),
);
	

	
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wewoshop_domain_model_orders', 'EXT:wewoshop/Resources/Private/Language/locallang_csh_tx_wewoshop_domain_model_orders.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wewoshop_domain_model_orders');
$TCA['tx_wewoshop_domain_model_orders'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_orders',
		'label' => 'order_nr',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'order_nr,order_position_nr,order_position_volume,product_uid,fe_user_uid,payment_method,mandate,mandate_reference,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Orders.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wewoshop_domain_model_orders.gif'
	),
);
	

	
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wewoshop_domain_model_payment', 'EXT:wewoshop/Resources/Private/Language/locallang_csh_tx_wewoshop_domain_model_payment.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wewoshop_domain_model_payment');
$TCA['tx_wewoshop_domain_model_payment'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_payment',
		'label' => 'payment_title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'payment_title,payment_method_id,debit_account_number,debit_bank_code,debit_bank_name,iban,bic,mandate,orders,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Payment.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wewoshop_domain_model_payment.gif'
	),
);
	

	
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wewoshop_domain_model_deliveryaddress', 'EXT:wewoshop/Resources/Private/Language/locallang_csh_tx_wewoshop_domain_model_deliveryaddress.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wewoshop_domain_model_deliveryaddress');
$TCA['tx_wewoshop_domain_model_deliveryaddress'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wewoshop/Resources/Private/Language/locallang_db.xlf:tx_wewoshop_domain_model_deliveryaddress',
		'label' => 'first_name_delivery',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'first_name_delivery,last_name_delivery,address_delivery,zip_delivery,city_delivery,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/DeliveryAddress.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wewoshop_domain_model_deliveryaddress.gif'
	),
);
	



	
	
	

	
	
	

	
	
	

	
	
	

	
	
	

	
	
	

	
	
	



## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>