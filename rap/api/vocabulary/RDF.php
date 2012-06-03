<?php
/**
*   Resource Description Framework (RDF) Vocabulary
*
*   @version $Id: RDF.php 431 2007-05-01 15:49:19Z cweiske $
*   @author Daniel Westphal (dawe@gmx.de)
*   @package vocabulary
*
*   Wrapper, defining resources for all terms of the
*   Resource Description Framework (RDF).
*   For details about RDF see: http://www.w3.org/RDF/.
*   Using the wrapper allows you to define all aspects of
*   the vocabulary in one spot, simplifing implementation and
*   maintainence.
*/


// RDF concepts (constants are defined in constants.php)
$RDF_Alt = new RDFResource(RDF_NAMESPACE_URI . RDF_ALT);
$RDF_Bag = new RDFResource(RDF_NAMESPACE_URI . RDF_BAG);
$RDF_Property = new RDFResource(RDF_NAMESPACE_URI . RDF_PROPERTY);
$RDF_Seq = new RDFResource(RDF_NAMESPACE_URI . RDF_SEQ);
$RDF_Statement = new RDFResource(RDF_NAMESPACE_URI . RDF_STATEMENT);
$RDF_List = new RDFResource(RDF_NAMESPACE_URI . RDF_LIST);
$RDF_nil = new RDFResource(RDF_NAMESPACE_URI . RDF_NIL);
$RDF_type = new RDFResource(RDF_NAMESPACE_URI . RDF_TYPE);
$RDF_rest = new RDFResource(RDF_NAMESPACE_URI . RDF_REST);
$RDF_first = new RDFResource(RDF_NAMESPACE_URI . RDF_FIRST);
$RDF_subject = new RDFResource(RDF_NAMESPACE_URI . RDF_SUBJECT);
$RDF_predicate = new RDFResource(RDF_NAMESPACE_URI . RDF_PREDICATE);
$RDF_object = new RDFResource(RDF_NAMESPACE_URI . RDF_OBJECT);
$RDF_Description = new RDFResource(RDF_NAMESPACE_URI . RDF_DESCRIPTION);
$RDF_ID = new RDFResource(RDF_NAMESPACE_URI . RDF_ID);
$RDF_about = new RDFResource(RDF_NAMESPACE_URI . RDF_ABOUT);
$RDF_aboutEach = new RDFResource(RDF_NAMESPACE_URI . RDF_ABOUT_EACH);
$RDF_aboutEachPrefix = new RDFResource(RDF_NAMESPACE_URI . RDF_ABOUT_EACH_PREFIX);
$RDF_bagID = new RDFResource(RDF_NAMESPACE_URI . RDF_BAG_ID);
$RDF_resource = new RDFResource(RDF_NAMESPACE_URI . RDF_RESOURCE);
$RDF_parseType = new RDFResource(RDF_NAMESPACE_URI . RDF_PARSE_TYPE);
$RDF_Literal = new RDFResource(RDF_NAMESPACE_URI . RDF_PARSE_TYPE_LITERAL);
$RDF_Resource = new RDFResource(RDF_NAMESPACE_URI . RDF_PARSE_TYPE_RESOURCE);
$RDF_li = new RDFResource(RDF_NAMESPACE_URI . RDF_LI);
$RDF_nodeID = new RDFResource(RDF_NAMESPACE_URI . RDF_NODEID);
$RDF_datatype = new RDFResource(RDF_NAMESPACE_URI . RDF_DATATYPE);
$RDF_seeAlso = new RDFResource(RDF_NAMESPACE_URI . RDF_SEEALSO);



?>