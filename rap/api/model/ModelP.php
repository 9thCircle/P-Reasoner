<?php
// ----------------------------------------------------------------------------------
// Model
// ----------------------------------------------------------------------------------
//
// Description               : Model package
//
//
// Author: Tobias Gauß	<tobias.gauss@web.de>
//
// ----------------------------------------------------------------------------------

// Include Model classes
require_once( __DIR__ . '/Node.php' );
require_once( __DIR__ . '/Literal.php' );
require_once( __DIR__ . '/Resource.php' );
require_once( __DIR__ . '/Blanknode.php' );
require_once( __DIR__ . '/Statement.php' );
require_once( __DIR__ . '/Model.php' );
require_once( __DIR__ . '/MemModel.php' );
require_once( __DIR__ . '/DbStore.php' );
require_once( __DIR__ . '/../util/StatementIterator.php' );
require_once( __DIR__ . '/ModelFactory.php' );
require_once( __DIR__ . '/../sparql/SparqlClient.php' );
require_once( __DIR__ . '/../sparql/ClientQuery.php' );

?>