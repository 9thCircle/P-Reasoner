<?php
// ----------------------------------------------------------------------------------
// InfModel Package
// ----------------------------------------------------------------------------------
//
// Description               : InfModel package
//
//
// Author: Daniel Westphal	<mail at d-westphal dot de>
//
// ----------------------------------------------------------------------------------

// Include InfModel classes

require_once __DIR__ . '/InfRule.php';
require_once __DIR__ . '/InfStatement.php';
require_once __DIR__ . '/InfModel.php';

// if there is not such value, load both; else load the specified InfModel
if (@$includeOptione['InfModel']['InfModel'] !== 'InfModelF') { 
	require_once __DIR__ . '/InfModelB.php';
}
if (@$includeOptione['InfModel']['InfModel'] !== 'InfModelB') { 
	require_once __DIR__ . '/InfModelF.php';
}

?>