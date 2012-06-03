<?php

// ----------------------------------------------------------------------------------
// Class: RDFNode
// ----------------------------------------------------------------------------------

/**
 * An abstract RDF node.
 * Can either be resource, literal or blank node.
 * RDFNode is used in some comparisons like is_a($obj, "RDFNode"),
 * meaning is $obj a resource, blank node or literal.
 *
 *
 * @version $Id: RDFNode.php 348 2007-03-12 10:04:10Z cweiske $
 * @author Chris Bizer <chris@bizer.de>
 * @package model
 * @abstract
 *
 */
class RDFNode extends RDFObject { } 

?>