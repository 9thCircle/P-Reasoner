<?php

// ----------------------------------------------------------------------------------
// Class: RDFBlankNode
// ----------------------------------------------------------------------------------


/**
 * An RDF blank node. 
 * In model theory, blank nodes are considered to be drawn from some set of 
 * 'anonymous' entities which have no label but are unique to the graph.
 * For serialization they are labeled with a URI or a _:X identifier.
 * 
 *
 * @version  $Id: Blanknode.php 453 2007-06-20 21:19:09Z cweiske $
 * @authors Chris Bizer <chris@bizer.de>,
 *          Radoslaw Oldakowski <radol@gmx.de>
 *
 * @package model
 * @access	public
 *
 */
class RDFBlankNode extends RDFResource
{
   /**
    * Constructor
	* You can supply a label or You supply a model and a unique ID is gernerated.
    *
    * @param	mixed	$namespace_or_uri_or_model
 	* @param 	string $localName
	* @access	public
    */
    public function __construct($namespace_or_uri_or_model, $localName = '')
	{
		
        if (is_a($namespace_or_uri_or_model, 'Model')) {
			// generate identifier
			$this->uri = $namespace_or_uri_or_model->getUniqueResourceURI(BNODE_PREFIX);
		} else {
			// set identifier
			$this->uri = $namespace_or_uri_or_model . $localName;
		}
    }
	
  /**
   * Returns the ID of the blank node.
   *
   * @return 	string
   * @access	public  
   */	
	public function getID()
	{
		return $this->uri;
	}
	
  /**
   * Dumps bNode.
   *
   * @access	public 
   * @return	string 
   */  
	public function toString()
	{
		return 'RDFBlankNode("' . $this->uri . '")';
	}
	
  /**
   * Checks if two blank nodes are equal.
   * Two blank nodes are equal, if they have the same temporary ID.
   *
   * @access	public 
   * @param		object	resource $that
   * @return	boolean 
   */  
   public function equals ($that)
   {
	    if ($this === $that) {
	      return TRUE;
	    }
		
        if ($that === NULL || get_class($that) !== 'RDFBlankNode') {
	      return FALSE;
	    }
	    
		return $this->getURI() === $that->getURI();
	}
	
    /**
    *   Doing string magic in PHP5
    *   @return string String representation of this RDFBlankNode
    */
    public function __toString()
    {
        return $this->toString();
    }
}

?>