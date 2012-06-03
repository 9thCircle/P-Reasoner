<?php
/**
*   RDF Vocabulary Description Language 1.0: RDF Schema (RDFS) Vocabulary
*
*   @version $Id: RDFS.php 431 2007-05-01 15:49:19Z cweiske $
*   @author Daniel Westphal (dawe@gmx.de)
*   @package vocabulary
*
*   Wrapper, defining resources for all terms of the
*   RDF Schema (RDFS).
*   For details about RDFS see: http://www.w3.org/TR/rdf-schema/.
*   Using the wrapper allows you to define all aspects of
*   the vocabulary in one spot, simplifing implementation and
*   maintainence.
*/
// RDFS concepts
$RDFS_Resource = new RDFResource(RDF_SCHEMA_URI . 'Resource');
$RDFS_Literal = new RDFResource(RDF_SCHEMA_URI . 'Literal');
$RDFS_Class = new RDFResource(RDF_SCHEMA_URI . 'Class');
$RDFS_Datatype = new RDFResource(RDF_SCHEMA_URI . 'Datatype');
$RDFS_Container = new RDFResource(RDF_SCHEMA_URI . 'Container');
$RDFS_ContainerMembershipProperty = new RDFResource(RDF_SCHEMA_URI . 'ContainerMembershipProperty');
$RDFS_subClassOf = new RDFResource(RDF_SCHEMA_URI . 'subClassOf');
$RDFS_subPropertyOf = new RDFResource(RDF_SCHEMA_URI . 'subPropertyOf');
$RDFS_domain = new RDFResource(RDF_SCHEMA_URI . 'domain');
$RDFS_range = new RDFResource(RDF_SCHEMA_URI . 'range');
$RDFS_label = new RDFResource(RDF_SCHEMA_URI . 'label');
$RDFS_comment = new RDFResource(RDF_SCHEMA_URI . 'comment');
$RDFS_member = new RDFResource(RDF_SCHEMA_URI . 'member');
$RDFS_seeAlso = new RDFResource(RDF_SCHEMA_URI . 'seeAlso');
$RDFS_isDefinedBy = new RDFResource(RDF_SCHEMA_URI . 'isDefinedBy');

?>