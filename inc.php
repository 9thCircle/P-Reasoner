<?php

/*
		This file is included by Tests and must not be accessed directly
		(because it does nothing).
*/


$start = (float)microtime(TRUE);


// RAP path, used in the API
define('RDFAPI_INCLUDE_DIR', __DIR__ . '/rap/api/');
// our namespace
define('NS', 'http://9thcircle.it/');


$includeOptione['InfModel']['InfModel'] = 'InfModelF';

require_once RDFAPI_INCLUDE_DIR . 'RdfAPI.php';
include_once RDFAPI_INCLUDE_DIR . PACKAGE_INFMODEL;
include_once RDFAPI_INCLUDE_DIR . PACKAGE_RESMODEL;

// import RDFS & OWL vocabularies
include_once RDFAPI_INCLUDE_DIR . 'vocabulary/OWL_RES.php';
include_once RDFAPI_INCLUDE_DIR . 'vocabulary/RDFS_RES.php';

?>