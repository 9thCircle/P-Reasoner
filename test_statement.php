<?php

require_once 'inc.php';


// use InfModelF
$infModel = ModelFactory::getInfModelF('onto://InfModelF/');
$infModel->startProfile();


// standard RDFS / OWL

$subPropertyOf   = RDFS_RES::SUB_PROPERTY_OF();
$subClassOf      = RDFS_RES::SUB_CLASS_OF();
$subClassOf      = OWL_RES::INVERSE_OF();


// define classes

$game       = new Resource(NS . 'Game');
$person     = new Resource(NS . 'Person');
$master     = new Resource(NS . 'Master');
$player     = new Resource(NS . 'Player');


// define properties

$pPlays           = new Resource(NS . 'Plays');
$pPlayedBy        = new Resource(NS . 'IsPlayedBy');
$pDirects         = new Resource(NS . 'Directs');
$pDirectedBy      = new Resource(NS . 'IsDirectedBy');
$pPartecipates    = new Resource(NS . 'Parecipates');
$pPartecipatedBy  = new Resource(NS . 'IsPartecipatedBy');
$pKnows           = new Resource(NS . 'Knows');


// define taxonomies (RDF triples)
// and add them to infModel

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