<?php

// ----------------------------------------------------------------------------------
// dataset Package
// ----------------------------------------------------------------------------------
//
// Description               : dataset package
//
// Author: Daniel Westphal	<http://www.d-westphal.de>
//
// ----------------------------------------------------------------------------------


// Constants
if (defined('ADODB_DB_DRIVER') !== TRUE) {
	if (isset($GLOBALS['dbConf']) !== TRUE) {
		define('ADODB_DB_DRIVER',    $GLOBALS['dbConf']['type']);
		define('ADODB_DB_HOST',      $GLOBALS['dbConf']['host']);
		define('ADODB_DB_NAME',      $GLOBALS['dbConf']['database']);
		define('ADODB_DB_USER',      $GLOBALS['dbConf']['user']);
		define('ADODB_DB_PASSWORD',  $GLOBALS['dbConf']['password']);
	} else {
		define('ADODB_DB_DRIVER',    'mysql');
		define('ADODB_DB_HOST'  ,    'localhost');
		define('ADODB_DB_NAME'  ,    'kbrdfdb');
		define('ADODB_DB_USER'  ,    'kbrdf');
		define('ADODB_DB_PASSWORD',  'db1');
	}
}

if (defined('ADODB_DEBUG_MODE') !== TRUE) {
	define('ADODB_DEBUG_MODE', '0');
}


// Include ResModel classes
require_once( RDFAPI_INCLUDE_DIR . 'dataset/Dataset.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/DatasetMem.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/DatasetDb.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/NamedGraphMem.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/NamedGraphDb.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/IteratorAllGraphsMem.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/IteratorAllGraphsDb.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/Quad.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/IteratorFindQuadsMem.php');
require_once( RDFAPI_INCLUDE_DIR . 'dataset/IteratorFindQuadsDb.php');
require_once( RDFAPI_INCLUDE_DIR . 'syntax/TriXParser.php');
require_once( RDFAPI_INCLUDE_DIR . 'syntax/TriXSerializer.php');
?>