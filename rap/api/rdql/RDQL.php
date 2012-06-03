<?php
// ----------------------------------------------------------------------------------
// RDQL
// ----------------------------------------------------------------------------------
//
// Description               : Rdql package
// ----------------------------------------------------------------------------------


// Constants
define('RDQL_ERR','RDQL error ');
define('RDQL_SYN_ERR','RDQL syntax error ');
define('RDQL_SEL_ERR', RDQL_ERR .'in the SELECT clause: ');
define('RDQL_SRC_ERR', RDQL_ERR .'in the SOURCE clause: ');
define('RDQL_WHR_ERR', RDQL_ERR .'in the WHERE clause: ');
define('RDQL_AND_ERR', RDQL_ERR .'in the AND clause: ');
define('RDQL_USG_ERR', RDQL_ERR .'in the USING clause: ');


// include RDQL classes
require_once( RDFAPI_INCLUDE_DIR . 'rdql/RdqlParser.php' );
require_once( RDFAPI_INCLUDE_DIR . 'rdql/RdqlEngine.php' );
require_once( RDFAPI_INCLUDE_DIR . 'rdql/RdqlDbEngine.php' );
require_once( RDFAPI_INCLUDE_DIR . 'rdql/RdqlMemEngine.php' );
require_once( RDFAPI_INCLUDE_DIR . 'rdql/RdqlResultIterator.php' );

?>