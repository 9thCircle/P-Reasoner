<?php
// ----------------------------------------------------------------------------------
// SPARQL
// ----------------------------------------------------------------------------------
//
// Description               : Sparql package
// ----------------------------------------------------------------------------------


// Attribute lists for describing Resources. ['resource type'] = array(att1, att2, att3, ...).
//

$sparql_describe = array(
	FOAF_NS.'person' => array(FOAF_NS.'name',FOAF_NS.'homepage',FOAF_NS.'mbox')
);


// include SPARQL classes
require_once( RDFAPI_INCLUDE_DIR . 'sparql/FilterFunctions.php' );
require_once( RDFAPI_INCLUDE_DIR . 'sparql/Constraint.php' );
require_once( RDFAPI_INCLUDE_DIR . 'sparql/GraphPattern.php' );
require_once( RDFAPI_INCLUDE_DIR . 'sparql/Query.php' );
require_once( RDFAPI_INCLUDE_DIR . 'sparql/QueryTriple.php' );
require_once( RDFAPI_INCLUDE_DIR . 'sparql/SparqlParserException.php' );
require_once( RDFAPI_INCLUDE_DIR . 'sparql/SparqlParser.php' );
require_once( RDFAPI_INCLUDE_DIR . 'sparql/SparqlEngine.php' );
require_once( RDFAPI_INCLUDE_DIR . 'sparql/SparqlEngineDb.php' );

?>