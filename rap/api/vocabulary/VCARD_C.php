<?php
/**
*   vCard profile defined by RFC 2426 - Vocabulary (Resource)
*
*   @version $Id: VCARD_C.php 431 2007-05-01 15:49:19Z cweiske $
*   @author Daniel Westphal (dawe@gmx.de)
*   @package vocabulary
*
*   Wrapper, defining resources for all terms of the
*   vCard Vocabulary.
*   For details about vCard see: http://www.w3.org/TR/vcard-rdf .
*   Using the wrapper allows you to define all aspects of
*   the vocabulary in one spot, simplifing implementation and
*   maintainence.
*/
class VCARD
{
	// VCARD concepts
	function UID()
	{
		return  new RDFResource(VCARD_NS.'UID');

	}

	function ORGPROPERTIES()
	{
		return  new RDFResource(VCARD_NS . 'ORGPROPERTIES');

	}

	function ADRTYPES()
	{
		return  new RDFResource(VCARD_NS . 'ADRTYPES');

	}

	function NPROPERTIES()
	{
		return  new RDFResource(VCARD_NS . 'NPROPERTIES');

	}

	function EMAILTYPES()
	{
		return  new RDFResource(VCARD_NS . 'EMAILTYPES');

	}

	function TELTYPES()
	{
		return  new RDFResource(VCARD_NS . 'TELTYPES');

	}

	function ADRPROPERTIES()
	{
		return  new RDFResource(VCARD_NS . 'ADRPROPERTIES');

	}

	function TZTYPES()
	{
		return  new RDFResource(VCARD_NS . 'TZTYPES');

	}

	function STREET()
	{
		return  new RDFResource(VCARD_NS . 'Street');

	}

	function AGENT()
	{
		return  new RDFResource(VCARD_NS . 'AGENT');

	}

	function SOURCE()
	{
		return  new RDFResource(VCARD_NS . 'SOURCE');

	}

	function BDAY()
	{
		return  new RDFResource(VCARD_NS . 'BDAY');

	}

	function REV()
	{
		return  new RDFResource(VCARD_NS . 'REV');

	}

	function SORT_STRING()
	{
		return  new RDFResource(VCARD_NS . 'SORT_STRING');

	}

	function ORGNAME()
	{
		return  new RDFResource(VCARD_NS . 'Orgname');

	}

	function CATEGORIES()
	{
		return  new RDFResource(VCARD_NS . 'CATEGORIES');

	}

	function N()
	{
		return  new RDFResource(VCARD_NS . 'N');

	}

	function PCODE()
	{
		return  new RDFResource(VCARD_NS . 'Pcode');

	}

	function PREFIX()
	{
		return  new RDFResource(VCARD_NS . 'Prefix');

	}

	function PHOTO()
	{
		return  new RDFResource(VCARD_NS . 'PHOTO');

	}

	function FN()
	{
		return  new RDFResource(VCARD_NS . 'FN');

	}

	function SUFFIX()
	{
		return  new RDFResource(VCARD_NS . 'Suffix');

	}

	function VCARD_CLASS()
	{
		return  new RDFResource(VCARD_NS . 'CLASS');

	}

	function ADR()
	{
		return  new RDFResource(VCARD_NS . 'ADR');

	}

	function REGION()
	{
		return  new RDFResource(VCARD_NS . 'Region');

	}

	function GEO()
	{
		return  new RDFResource(VCARD_NS . 'GEO');

	}

	function EXTADD()
	{
		return  new RDFResource(VCARD_NS . 'Extadd');

	}

	function GROUP()
	{
		return  new RDFResource(VCARD_NS . 'GROUP');

	}

	function EMAIL()
	{
		return  new RDFResource(VCARD_NS . 'EMAIL');

	}

	function FAMILY()
	{
		return  new RDFResource(VCARD_NS . 'Family');

	}

	function TZ()
	{
		return  new RDFResource(VCARD_NS . 'TZ');

	}

	function NAME()
	{
		return  new RDFResource(VCARD_NS . 'NAME');

	}

	function ORGUNIT()
	{
		return  new RDFResource(VCARD_NS . 'Orgunit');

	}

	function COUNTRY()
	{
		return  new RDFResource(VCARD_NS . 'Country');

	}

	function SOUND()
	{
		return  new RDFResource(VCARD_NS . 'SOUND');

	}

	function TITLE()
	{
		return  new RDFResource(VCARD_NS . 'TITLE');

	}

	function MAILER()
	{
		return  new RDFResource(VCARD_NS . 'MAILER');

	}

	function OTHER()
	{
		return  new RDFResource(VCARD_NS . 'Other');

	}

	function LOCALITY()
	{
		return  new RDFResource(VCARD_NS . 'Locality');

	}

	function POBOX()
	{
		return  new RDFResource(VCARD_NS . 'Pobox');

	}

	function KEY()
	{
		return  new RDFResource(VCARD_NS . 'KEY');

	}

	function PRODID()
	{
		return  new RDFResource(VCARD_NS . 'PRODID');

	}

	function GIVEN()
	{
		return  new RDFResource(VCARD_NS . 'Given');

	}

	function LABEL()
	{
		return  new RDFResource(VCARD_NS . 'LABEL');

	}

	function TEL()
	{
		return  new RDFResource(VCARD_NS . 'TEL');

	}

	function NICKNAME()
	{
		return  new RDFResource(VCARD_NS . 'NICKNAME');

	}

	function ROLE()
	{
		return  new RDFResource(VCARD_NS . 'ROLE');
	}
}

?>