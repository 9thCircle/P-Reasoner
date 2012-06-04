<?php


// RAP path, used in the API
define('RDFAPI_INCLUDE_DIR', __DIR__ . '/rap/api/');

$includeOptione['InfModel']['InfModel'] = 'InfModelF';

require_once RDFAPI_INCLUDE_DIR . 'RdfAPI.php';
include_once RDFAPI_INCLUDE_DIR . PACKAGE_INFMODEL;
include_once RDFAPI_INCLUDE_DIR . PACKAGE_RESMODEL;

// import RDFS & OWL vocabularies
include_once RDFAPI_INCLUDE_DIR . 'vocabulary/OWL_RES.php';
include_once RDFAPI_INCLUDE_DIR . 'vocabulary/RDFS_RES.php';

$stmt = new Statement(new RDFResource('Master'), new RDFResource('Directs'), new RDFResource('Game'));

// test getSubject() + getPredicate() + getObject()

$start = (float)microtime(TRUE);
for ($i = 0; $i < 10000; $i++) {
	$s  = $stmt->getSubject();
	$p  = $stmt->getPredicate();
	$o  = $stmt->getObject();
}
$duration = (float)microtime(TRUE) - $start;

echo '<hr/><h3>getSubject() + getPredicate() + getObject()</h3>';
echo '<p>Elapsed Time: ' . $duration . '</p>';

// test getSPO()

$start = (float)microtime(TRUE);
for ($i = 0; $i < 10000; $i++) {
	$stmt->getSPO($s, $p, $o);
}
$duration = (float)microtime(TRUE) - $start;

echo '<hr/><h3>getSPO()</h3>';
echo '<p>Elapsed Time: ' . $duration . '</p>';

// no fatal errors
echo '<p>&gt;&gt; END OF FILE</p>';

?>