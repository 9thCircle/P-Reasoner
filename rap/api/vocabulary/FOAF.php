<?php
/**
*   Friend of a Friend (FOAF) Vocabulary (Resource)
*
*   @version $Id: FOAF.php 431 2007-05-01 15:49:19Z cweiske $
*   @author Tobias Gauß (tobias.gauss@web.de)
*   @package vocabulary
*
*   Wrapper, defining resources for all terms of the
*   Friend of a Friend project (FOAF).
*   For details about FOAF see: http://xmlns.com/foaf/0.1/.
*   Using the wrapper allows you to define all aspects of
*   the vocabulary in one spot, simplifing implementation and
*   maintainence.
*/



// FOAF concepts
$FOAF_Agent = new RDFResource(FOAF_NS . 'Agent');
$FOAF_Document = new RDFResource(FOAF_NS . 'Document');
$FOAF_Group = new RDFResource(FOAF_NS . 'Group');
$FOAF_Image = new RDFResource(FOAF_NS . 'Image');
$FOAF_OnlineAccount = new RDFResource(FOAF_NS . 'OnlineAccount');
$FOAF_OnlineChatAccount = new RDFResource(FOAF_NS . 'OnlineChatAccount');
$FOAF_OnlineEcommerceAccount = new RDFResource(FOAF_NS . 'OnlineEcommerceAccount');
$FOAF_OnlineGamingAccount = new RDFResource(FOAF_NS . 'OnlineGamingAccount');
$FOAF_Organization = new RDFResource(FOAF_NS . 'Organization');
$FOAF_Person = new RDFResource(FOAF_NS . 'Person');
$FOAF_PersonalProfileDocument = new RDFResource(FOAF_NS . 'PersonalProfileDocument');
$FOAF_Project = new RDFResource(FOAF_NS . 'Project');
$FOAF_accountName = new RDFResource(FOAF_NS . 'accountName');
$FOAF_accountServiceHomepage = new RDFResource(FOAF_NS . 'accountServiceHomepage');
$FOAF_aimChatID = new RDFResource(FOAF_NS . 'aimChatID');
$FOAF_based_near = new RDFResource(FOAF_NS . 'based_near');
$FOAF_currentProject = new RDFResource(FOAF_NS . 'currentProject');
$FOAF_depiction = new RDFResource(FOAF_NS . 'depiction');
$FOAF_depicts = new RDFResource(FOAF_NS . 'depicts');
$FOAF_dnaChecksum = new RDFResource(FOAF_NS . 'dnaChecksum');
$FOAF_family_name = new RDFResource(FOAF_NS . 'family_name');
$FOAF_firstName = new RDFResource(FOAF_NS . 'firstName');
$FOAF_fundedBy = new RDFResource(FOAF_NS . 'fundedBy');
$FAOF_geekcode = new RDFResource(FOAF_NS . 'geekcode');
$FOAF_gender = new RDFResource(FOAF_NS . 'gender');
$FOAF_givenname = new RDFResource(FOAF_NS . 'givenname');
$FOAF_holdsAccount = new RDFResource(FOAF_NS . 'holdsAccount');
$FOAF_homepage = new RDFResource(FOAF_NS . 'homepage');
$FOAF_icqChatID = new RDFResource(FOAF_NS . 'icqChatID');
$FOAF_img = new RDFResource(FOAF_NS . 'img');
$FOAF_interest = new RDFResource(FOAF_NS . 'interest');
$FOAF_jabberID = new RDFResource(FOAF_NS . 'jabberID');
$FOAF_knows = new RDFResource(FOAF_NS . 'knows');
$FOAF_logo = new RDFResource(FOAF_NS . 'logo');
$FOAF_made = new RDFResource(FOAF_NS . 'made');
$FOAF_maker = new RDFResource(FOAF_NS . 'maker');
$FOAF_mbox = new RDFResource(FOAF_NS . 'mbox');
$FOAF_mbox_sha1sum = new RDFResource(FOAF_NS . 'mbox_sha1sum');
$FOAF_member = new RDFResource(FOAF_NS . 'member');
$FOAF_membershipClass =new RDFResource(FOAF_NS . 'membershipClass');
$FOAF_msnChatID = new RDFResource(FOAF_NS . 'msnChatID');
$FOAF_myersBriggs = new RDFResource(FOAF_NS . 'myersBriggs');
$FOAF_name = new RDFResource(FOAF_NS . 'name');
$FOAF_nick = new RDFResource(FOAF_NS . 'nick');
$FOAF_page = new RDFResource(FOAF_NS . 'page');
$FOAF_pastProject = new RDFResource(FOAF_NS . 'pastProject');
$FOAF_phone = new RDFResource(FOAF_NS . 'phone');
$FOAF_plan = new RDFResource(FOAF_NS . 'plan');
$FOAF_primaryTopic = new RDFResource(FOAF_NS . 'primaryTopic');
$FOAF_publications = new RDFResource(FOAF_NS . 'publications');
$FOAF_schoolHomepage = new RDFResource (FOAF_NS . 'schoolHomepage');
$FOAF_sha1 = new RDFResource (FOAF_NS . 'sha1');
$FOAF_surname = new RDFResource (FOAF_NS . 'surname');
$FOAF_theme = new RDFResource(FOAF_NS . 'theme');
$FOAF_thumbnail = new RDFResource(FOAF_NS . 'thumbnail');
$FOAF_tipjar = new RDFResource(FOAF_NS . 'tipjar');
$FOAF_title = new RDFResource(FOAF_NS . 'title');
$FOAF_topic = new RDFResource(FOAF_NS . 'topic');
$FOAF_topic_interest = new RDFResource(FOAF_NS . 'topic_interest');
$FOAF_weblog = new RDFResource(FOAF_NS . 'weblog');
$FOAF_workInfoHomepage = new RDFResource(FOAF_NS . 'workInfoHomepage');
$FOAF_workplaceHomepage = new RDFResource(FOAF_NS . 'workplaceHomepage');
$FOAF_yahooChatID = new RDFResource(FOAF_NS . 'yahooChatID');

?>