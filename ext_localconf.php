<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Wewo.' . $_EXTKEY,
	'Wewoshopp1',
	array(
		'Product' => 'list, sortList, saveInSession, search, show, new, create, edit, update, delete, storeObjectIntoSession, restoreObjectFromSession, deleteSession, changeBasketQuantity, deleteBasketPosition',
		'Category' => 'list, show, new, create, edit, update, delete',
		'FrontendUser' => 'list, show, new, create, edit, update, delete, verifyFeUser, feUserLogin, createDelivery',
		'FrontendUserVerify' => 'showForm, list, show, new, create, edit, update, delete, verifyFeUser, showPaymentForm',
		'Orders' => 'list, show, new, create, edit, update, delete, confirm, showPaymentForm, paymentMethodToSession ',
		'Payment' => 'list, show, new, create, edit, update, delete, paymentMethodToSession, createMandate',
        'DeliveryAddress' => 'list, show, new, create',
		
	),
	// non-cacheable actions
	array(
		'Product' => 'create, update, delete, search, storeObjectIntoSession, restoreObjectFromSession, deleteSession, changeBasketQuantity, deleteBasketPosition',
		'Category' => 'create, update, delete',
		'FrontendUser' => 'list, show, new, create, edit, update, delete, verifyFeUser, createDelivery',
		'FrontendUserVerify' => 'list, show, new, create, edit, update, delete, verifyFeUser',
        'DeliveryAddress' => 'list, show, new, create',
		
	)
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>