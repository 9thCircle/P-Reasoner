<?php

// ----------------------------------------------------------------------------------
// RAP Net API Fetch Operaton
// ----------------------------------------------------------------------------------

/**
 * The fetch operation gets all known information about a ressource.
 *
 * @version  $Id: fetch.php 268 2006-05-15 05:28:09Z tgauss $
 * @author Phil Dawes <pdawes@users.sf.net>
 *
 * @package netapi
 * @todo nothing
 * @access	public
 */

function fetch($model,$serializer)
{
	$urir = new Resource($_REQUEST['r']);
	$outm = new MemModel();
	getBNodeClosure($urir, $model, $outm);
	echo $serializer->Serialize($outm);
	$outm->close();
}

function getBNodeClosure($res, $sourcem, &$outm)
{
	$resourcem = $sourcem->find($res, NULL, NULL);
	$it = $resourcem->getStatementIterator();
	while ($it->hasNext()){
		$stmt = $it->next();
		$outm->add(new Statement($res,$stmt->getPredicate(), $stmt->getObject()));
		if (is_a($stmt->getObject(),'BlankNode')){
			getBNodeClosure($stmt->getObject(),$sourcem,$outm);
		}
	}  
}

?>