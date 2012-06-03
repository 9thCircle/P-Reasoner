<?php
/**
*   Dublin Core Vocabulary (Resource)
*
*   @version $Id: DC_C.php 431 2007-05-01 15:49:19Z cweiske $
*   @author Chris Bizer (chris@bizer.de)
*   @package vocabulary
*
*   Wrapper, defining resources for all terms of the Dublin
*   Core Vocabulary. For details about DC see: http://dublincore.org/
*   Using the wrapper allows you to define all aspects of
*   the vocabulary in one spot, simplifing implementation and
*   maintainence.
*/
class DC{
	// DC concepts
	function CONTRIBUTOR()
	{
		return  new RDFResource(DC_NS . 'contributor');

	}

	function COVERAGE()
	{
		return  new RDFResource(DC_NS . 'coverage');

	}

	function CREATOR()
	{
		return  new RDFResource(DC_NS . 'creator');

	}

	function DATE()
	{
		return  new RDFResource(DC_NS . 'date');

	}

	function DESCRIPTION()
	{
		return  new RDFResource(DC_NS . 'description');

	}

	function FORMAT()
	{
		return  new RDFResource(DC_NS . 'format');

	}

	function IDENTIFIER()
	{
		return  new RDFResource(DC_NS . 'identifier');

	}

	function LANGUAGE()
	{
		return  new RDFResource(DC_NS . 'language');

	}

	function PUBLISHER()
	{
		return  new RDFResource(DC_NS . 'publisher');

	}

	function RIGHTS()
	{
		return  new RDFResource(DC_NS . 'rights');

	}

	function SOURCE()
	{
		return  new RDFResource(DC_NS . 'source');

	}

	function SUBJECT()
	{
		return  new RDFResource(DC_NS . 'subject');

	}

	function TITLE()
	{
		return  new RDFResource(DC_NS . 'title');

	}

	function TYPE()
	{
		return  new RDFResource(DC_NS . 'type');
	}


	// Other Elements and Element Refinements
	function ABSTRACT_()
	{
		return  new RDFResource(DCTERM_NS . 'abstract');

	}

	function ACCESS_RIGHTS()
	{
		return  new RDFResource(DCTERM_NS . 'accessRights');

	}

	function ALTERNATIVE()
	{
		return  new RDFResource(DCTERM_NS . 'alternative');

	}

	function AUDIENCE()
	{
		return  new RDFResource(DCTERM_NS . 'audience');

	}

	function AVAILABLE()
	{
		return  new RDFResource(DCTERM_NS . 'available');

	}

	function BIBLIOGRAPHIC_CITATION()
	{
		return  new RDFResource(DCTERM_NS . 'bibliographicCitation');

	}

	function CONFORMS_TO()
	{
		return  new RDFResource(DCTERM_NS . 'conformsTo');

	}

	function CREATED()
	{
		return  new RDFResource(DCTERM_NS . 'created');

	}

	function DATE_ACCEPTED()
	{
		return  new RDFResource(DCTERM_NS . 'dateAccepted');

	}

	function DATE_COPYRIGHTED()
	{
		return  new RDFResource(DCTERM_NS . 'dateCopyrighted');

	}

	function DATE_SUBMITTED()
	{
		return  new RDFResource(DCTERM_NS . 'dateSubmitted');

	}

	function EDUCATION_LEVEL()
	{
		return  new RDFResource(DCTERM_NS . 'educationLevel');

	}

	function EXTENT()
	{
		return  new RDFResource(DCTERM_NS . 'extent');

	}

	function HAS_FORMAT()
	{
		return  new RDFResource(DCTERM_NS . 'hasFormat');

	}

	function HAS_PART()
	{
		return  new RDFResource(DCTERM_NS . 'hasPart');

	}

	function HAS_VERSION()
	{
		return  new RDFResource(DCTERM_NS . 'hasVersion');

	}

	function IS_FORMAT_OF()
	{
		return  new RDFResource(DCTERM_NS . 'isFormatOf');

	}

	function IS_PART_OF()
	{
		return  new RDFResource(DCTERM_NS . 'isPartOf');

	}

	function IS_REFERENCED_BY()
	{
		return  new RDFResource(DCTERM_NS . 'isReferencedBy');

	}

	function IS_REPLACED_BY()
	{
		return  new RDFResource(DCTERM_NS . 'isReplacedBy');

	}

	function IS_REQUIRED_BY()
	{
		return  new RDFResource(DCTERM_NS . 'isRequiredBy');

	}

	function ISSUED()
	{
		return  new RDFResource(DCTERM_NS . 'issued');

	}

	function IS_VERSION_OF()
	{
		return  new RDFResource(DCTERM_NS . 'isVersionOf');

	}

	function LICENSE()
	{
		return  new RDFResource(DCTERM_NS . 'license');

	}

	function MEDIATOR()
	{
		return  new RDFResource(DCTERM_NS . 'mediator');

	}

	function MEDIUM()
	{
		return  new RDFResource(DCTERM_NS . 'medium');

	}

	function MODIFIED()
	{
		return  new RDFResource(DCTERM_NS . 'modified');

	}

	function REFERENCES()
	{
		return  new RDFResource(DCTERM_NS . 'references');

	}

	function REPLACES()
	{
		return  new RDFResource(DCTERM_NS . 'replaces');

	}

	function REQUIRES()
	{
		return  new RDFResource(DCTERM_NS . 'requires');

	}

	function RIGHTS_HOLDER()
	{
		return  new RDFResource(DCTERM_NS . 'rightsHolder');

	}

	function SPATIAL()
	{
		return  new RDFResource(DCTERM_NS . 'spatial');

	}

	function TABLE_OF_CONTENTS()
	{
		return  new RDFResource(DCTERM_NS . 'tableOfContents');

	}

	function TEMPORAL()
	{
		return  new RDFResource(DCTERM_NS . 'temporal');

	}

	function VALID()
	{
		return  new RDFResource(DCTERM_NS . 'valid');

	}


	// Encoding schemes
	function BOX()
	{
		return  new RDFResource(DCTERM_NS . 'Box');

	}

	function DCMI_TYPE()
	{
		return  new RDFResource(DCTERM_NS . 'DCMIType');

	}

	function IMT()
	{
		return  new RDFResource(DCTERM_NS . 'IMT');

	}

	function ISO3166()
	{
		return  new RDFResource(DCTERM_NS . 'ISO3166');

	}

	function ISO639_2()
	{
		return  new RDFResource(DCTERM_NS . 'ISO639-2');

	}

	function LCC()
	{
		return  new RDFResource(DCTERM_NS . 'LCC');

	}

	function LCSH()
	{
		return  new RDFResource(DCTERM_NS . 'LCSH');

	}

	function MESH()
	{
		return  new RDFResource(DCTERM_NS . 'MESH');

	}

	function PERIOD()
	{
		return  new RDFResource(DCTERM_NS . 'Period');

	}

	function POINT()
	{
		return  new RDFResource(DCTERM_NS . 'Point');

	}

	function RFC1766()
	{
		return  new RDFResource(DCTERM_NS . 'RFC1766');

	}

	function RFC3066()
	{
		return  new RDFResource(DCTERM_NS . 'RFC3066');

	}

	function TGN()
	{
		return  new RDFResource(DCTERM_NS . 'TGN');

	}

	function UDC()
	{
		return  new RDFResource(DCTERM_NS . 'UDC');

	}

	function URI()
	{
		return  new RDFResource(DCTERM_NS . 'URI');

	}

	function W3CDTF()
	{
		return  new RDFResource(DCTERM_NS . 'W3CDTF');

	}


	// DCMI Type Vocabulary
	function COLLECTION()
	{
		return  new RDFResource(DCMITYPE_NS . 'Collection');

	}

	function DATASET()
	{
		return  new RDFResource(DCMITYPE_NS . 'Dataset');

	}

	function EVENT()
	{
		return  new RDFResource(DCMITYPE_NS . 'Event');

	}

	function IMAGE()
	{
		return  new RDFResource(DCMITYPE_NS . 'Image');

	}

	function INTERACTIVERESOURCE()
	{
		return  new RDFResource(DCMITYPE_NS . 'Interactive_Resource');

	}

	function MOVINGIMAGE()
	{
		return  new RDFResource(DCMITYPE_NS . 'Moving_Image');

	}

	function PHYSICALOBJECT()
	{
		return  new RDFResource(DCMITYPE_NS . 'Physical_Object');

	}

	function SERVICE()
	{
		return  new RDFResource(DCMITYPE_NS . 'Service');

	}

	function SOFTWARE()
	{
		return  new RDFResource(DCMITYPE_NS . 'Software');

	}

	function SOUND()
	{
		return  new RDFResource(DCMITYPE_NS . 'Sound');

	}

	function STILLIMAGE()
	{
		return  new RDFResource(DCMITYPE_NS . 'Still_Image');

	}

	function TEXT()
	{
		return  new RDFResource(DCMITYPE_NS . 'Text');
	}

}


?>