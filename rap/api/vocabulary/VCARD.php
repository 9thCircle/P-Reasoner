<?php
/**
*   vCard profile defined by RFC 2426 - Vocabulary
*
*   @version $Id: VCARD.php 431 2007-05-01 15:49:19Z cweiske $
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

// VCARD concepts
$VCARD_UID = new RDFResource(VCARD_NS.'UID');
$VCARD_ORGPROPERTIES = new RDFResource(VCARD_NS . 'ORGPROPERTIES');
$VCARD_ADRTYPES = new RDFResource(VCARD_NS . 'ADRTYPES');
$VCARD_NPROPERTIES = new RDFResource(VCARD_NS . 'NPROPERTIES');
$VCARD_EMAILTYPES = new RDFResource(VCARD_NS . 'EMAILTYPES');
$VCARD_TELTYPES = new RDFResource(VCARD_NS . 'TELTYPES');
$VCARD_ADRPROPERTIES = new RDFResource(VCARD_NS . 'ADRPROPERTIES');
$VCARD_TZTYPES = new RDFResource(VCARD_NS . 'TZTYPES');
$VCARD_Street = new RDFResource(VCARD_NS . 'Street');
$VCARD_AGENT = new RDFResource(VCARD_NS . 'AGENT');
$VCARD_SOURCE = new RDFResource(VCARD_NS . 'SOURCE');
$VCARD_BDAY = new RDFResource(VCARD_NS . 'BDAY');
$VCARD_REV = new RDFResource(VCARD_NS . 'REV');
$VCARD_SORT_STRING = new RDFResource(VCARD_NS . 'SORT_STRING');
$VCARD_Orgname = new RDFResource(VCARD_NS . 'Orgname');
$VCARD_CATEGORIES = new RDFResource(VCARD_NS . 'CATEGORIES');
$VCARD_N = new RDFResource(VCARD_NS . 'N');
$VCARD_Pcode = new RDFResource(VCARD_NS . 'Pcode');
$VCARD_Prefix = new RDFResource(VCARD_NS . 'Prefix');
$VCARD_PHOTO = new RDFResource(VCARD_NS . 'PHOTO');
$VCARD_FN = new RDFResource(VCARD_NS . 'FN');
$VCARD_Suffix = new RDFResource(VCARD_NS . 'Suffix');
$VCARD_CLASS = new RDFResource(VCARD_NS . 'CLASS');
$VCARD_ADR = new RDFResource(VCARD_NS . 'ADR');
$VCARD_Region = new RDFResource(VCARD_NS . 'Region');
$VCARD_GEO = new RDFResource(VCARD_NS . 'GEO');
$VCARD_Extadd = new RDFResource(VCARD_NS . 'Extadd');
$VCARD_GROUP = new RDFResource(VCARD_NS . 'GROUP');
$VCARD_EMAIL = new RDFResource(VCARD_NS . 'EMAIL');
$VCARD_Family = new RDFResource(VCARD_NS . 'Family');
$VCARD_TZ = new RDFResource(VCARD_NS . 'TZ');
$VCARD_NAME = new RDFResource(VCARD_NS . 'NAME');
$VCARD_Orgunit = new RDFResource(VCARD_NS . 'Orgunit');
$VCARD_Country = new RDFResource(VCARD_NS . 'Country');
$VCARD_SOUND = new RDFResource(VCARD_NS . 'SOUND');
$VCARD_TITLE = new RDFResource(VCARD_NS . 'TITLE');
$VCARD_MAILER = new RDFResource(VCARD_NS . 'MAILER');
$VCARD_Other = new RDFResource(VCARD_NS . 'Other');
$VCARD_Locality = new RDFResource(VCARD_NS . 'Locality');
$VCARD_Pobox = new RDFResource(VCARD_NS . 'Pobox');
$VCARD_KEY = new RDFResource(VCARD_NS . 'KEY');
$VCARD_PRODID = new RDFResource(VCARD_NS . 'PRODID');
$VCARD_Given = new RDFResource(VCARD_NS . 'Given');
$VCARD_LABEL = new RDFResource(VCARD_NS . 'LABEL');
$VCARD_TEL = new RDFResource(VCARD_NS . 'TEL');
$VCARD_NICKNAME = new RDFResource(VCARD_NS . 'NICKNAME');
$VCARD_ROLE = new RDFResource(VCARD_NS . 'ROLE');

?>