<?php

require_once 'inc.php';


// use InfModelF
$infModel = ModelFactory::getInfModelF('onto://InfModelF/', TRUE);
$infModel->startProfile();


// standard RDFS / OWL

$subPropertyOf   = RDFS_RES::SUB_PROPERTY_OF();
$subClassOf      = RDFS_RES::SUB_CLASS_OF();
$subClassOf      = OWL_RES::INVERSE_OF();


// define classes

$game       = new RDFResource(NS . 'Game');
$ktulu      = new RDFResource(NS . 'CallOfChtulhu');
$ktulu2     = new RDFResource(NS . 'CallOfChtulhu2');
$person     = new RDFResource(NS . 'Person');
$master     = new RDFResource(NS . 'Master');
$player     = new RDFResource(NS . 'Player');


// define properties

$pPlays           = new RDFResource(NS . 'Plays');
$pPlayedBy        = new RDFResource(NS . 'IsPlayedBy');
$pDirects         = new RDFResource(NS . 'Directs');
$pDirectedBy      = new RDFResource(NS . 'IsDirectedBy');
$pPartecipates    = new RDFResource(NS . 'Partecipates');
$pPartecipatedBy  = new RDFResource(NS . 'IsPartecipatedBy');
$pKnows           = new RDFResource(NS . 'Knows');


// define taxonomies (RDF triples)
// and add them to infModel

$infModel->add(new Statement($ktulu,   $subClassOf,  $game));
$infModel->add(new Statement($ktulu2,  $subClassOf,  $ktulu));

$infModel->add(new Statement($master,  $subClassOf,  $person));
$infModel->add(new Statement($player,  $subClassOf,  $person));

$infModel->add(new Statement($pPlays,    $subPropertyOf,  $pPartecipates));
$infModel->add(new Statement($pDirects,  $subPropertyOf,  $pPartecipates));


// property characteristics

$infModel->add(new Statement($pPlayedBy,        OWL_RES::INVERSE_OF(),  $pPlays));
$infModel->add(new Statement($pDirectedBy,      OWL_RES::INVERSE_OF(),  $pDirects));
$infModel->add(new Statement($pPartecipatedBy,  OWL_RES::INVERSE_OF(),  $pPartecipates));

$infModel->add(new Statement($pKnows,  OWL_RES::SYMMETRIC_PROPERTY(), $pKnows));


// define ontologic statements

$infModel->add(new Statement($master,  $pDirects,  $game));
$infModel->add(new Statement($player,  $pPlays,    $game));
$infModel->add(new Statement($master,  $pKnows,    $player));

require_once 'end.php';

?>