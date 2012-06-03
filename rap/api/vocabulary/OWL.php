<?php
/**
*   OWL Vocabulary
*
*   @version $Id: OWL.php 431 2007-05-01 15:49:19Z cweiske $
*   @author Daniel Westphal (dawe@gmx.de)
*   @package vocabulary
*
*   Wrapper, defining resources for all terms of theWeb
*   Ontology Language (OWL). For details about OWL see:
*   http://www.w3.org/TR/owl-ref/
*   Using the wrapper allows you to define all aspects of
*   the vocabulary in one spot, simplifing implementation and
*   maintainence.
*/

// OWL concepts
$OWL_AnnotationProperty = new RDFResource(OWL_NS . 'AnnotationProperty');
$OWL_AllDifferent = new RDFResource(OWL_NS . 'AllDifferent');
$OWL_allValuesFrom = new RDFResource(OWL_NS . 'allValuesFrom');
$OWL_backwardCompatibleWith = new RDFResource(OWL_NS . 'backwardCompatibleWith');
$OWL_cardinality = new RDFResource(OWL_NS . 'cardinality');
$OWL_Class = new RDFResource(OWL_NS . 'Class');
$OWL_complementOf = new RDFResource(OWL_NS . 'complementOf');
$OWL_Datatype = new RDFResource(OWL_NS . 'Datatype');
$OWL_DatatypeProperty = new RDFResource(OWL_NS . 'DatatypeProperty');
$OWL_DataRange = new RDFResource(OWL_NS . 'DataRange');
$OWL_DatatypeRestriction = new RDFResource(OWL_NS . 'DatatypeRestriction');
$OWL_DeprecatedClass = new RDFResource(OWL_NS . 'DeprecatedClass');
$OWL_DeprecatedProperty = new RDFResource(OWL_NS . 'DeprecatedProperty');
$OWL_distinctMembers = new RDFResource(OWL_NS . 'distinctMembers');
$OWL_differentFrom = new RDFResource(OWL_NS . 'differentFrom');
$OWL_disjointWith = new RDFResource(OWL_NS . 'disjointWith');
$OWL_equivalentClass = new RDFResource(OWL_NS . 'equivalentClass');
$OWL_equivalentProperty = new RDFResource(OWL_NS . 'equivalentProperty');
$OWL_FunctionalProperty = new RDFResource(OWL_NS . 'FunctionalProperty');
$OWL_hasValue = new RDFResource(OWL_NS . 'hasValue');
$OWL_incompatibleWith = new RDFResource(OWL_NS . 'incompatibleWith');
$OWL_imports = new RDFResource(OWL_NS . 'imports');
$OWL_intersectionOf = new RDFResource(OWL_NS . 'intersectionOf');
$OWL_InverseFunctionalProperty = new RDFResource(OWL_NS . 'InverseFunctionalProperty');
$OWL_inverseOf = new RDFResource(OWL_NS . 'inverseOf');
$OWL_maxCardinality = new RDFResource(OWL_NS . 'maxCardinality');
$OWL_minCardinality = new RDFResource(OWL_NS . 'minCardinality');
$OWL_Nothing = new RDFResource(OWL_NS . 'Nothing');
$OWL_ObjectClass = new RDFResource(OWL_NS . 'ObjectClass');
$OWL_ObjectProperty = new RDFResource(OWL_NS . 'ObjectProperty');
$OWL_ObjectRestriction = new RDFResource(OWL_NS . 'ObjectRestriction');
$OWL_oneOf = new RDFResource(OWL_NS . 'oneOf');
$OWL_onProperty = new RDFResource(OWL_NS . 'onProperty');
$OWL_Ontology = new RDFResource(OWL_NS . 'Ontology');
$OWL_priorVersion = new RDFResource(OWL_NS . 'priorVersion');
$OWL_Property = new RDFResource(OWL_NS . 'Property');
$OWL_Restriction = new RDFResource(OWL_NS . 'Restriction');
$OWL_sameAs = new RDFResource(OWL_NS . 'sameAs');
$OWL_sameClassAs = new RDFResource(OWL_NS . 'sameClassAs');
$OWL_sameIndividualAs = new RDFResource(OWL_NS . 'sameIndividualAs');
$OWL_samePropertyAs = new RDFResource(OWL_NS . 'samePropertyAs');
$OWL_someValuesFrom = new RDFResource(OWL_NS . 'someValuesFrom');
$OWL_SymmetricProperty = new RDFResource(OWL_NS . 'SymmetricProperty');
$OWL_Thing = new RDFResource(OWL_NS . 'Thing');
$OWL_TransitiveProperty = new RDFResource(OWL_NS . 'TransitiveProperty');
$OWL_unionOf = new RDFResource(OWL_NS . 'unionOf');
$OWL_versionInfo = new RDFResource(OWL_NS . 'versionInfo');

?>