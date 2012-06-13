<?php

// ----------------------------------------------------------------------------------
// Class: RDFResource
// ----------------------------------------------------------------------------------

/**
 * An RDF resource.
 * Every RDF resource must have a URIref.
 * URIrefs are treated as logical constants, i.e. as names which denote something
 * (the things are called 'resources', but no assumptions are made about the nature of resources.)
 * Many RDF resources are pieces of vocabulary. They typically have a namespace
 * and a local name. In this case, a URI is composed as a
 * concatenation of the namespace and the local name.
 *
 *
 * @version  $Id: RDFResource.php 453 2007-06-20 21:19:09Z cweiske $
 * @author Chris Bizer <chris@bizer.de>
 *
 * @package model
 * @access	public
 *
 */
class RDFResource extends RDFNode
{
 	/**
	* URIref to the resource
	* @var		string
	* @access	private
	*/
    protected $uri = '';
	
	
   /**
    * Constructor
	* Takes an URI or a namespace/localname combination
    *
    * @param	string	$namespace_or_uri
 	* @param string $localName
	* @access	public
    */
    public function RDFResource($namespace_or_uri, $localName = '')
	{
		$this->uri = $namespace_or_uri . $localName;
	}
	
  /**
   * Returns the URI of the resource.
   * @return string
   * @access	public
   */
	public function getURI()
	{
		return $this->uri;
	}

	/**
	 * Returns the label of the resource, which is the URI of the resource.
     * @access	public
	 * @return string
	 */
    public function getLabel()
	{
    	return $this->uri;
    }

  /**
   * Returns the namespace of the resource. May return null.
   * @access	public
   * @return string
   */
	public function getNamespace()
	{
		return RDFUtil::guessNamespace($this->uri);
	}

  /**
   * Returns the local name of the resource.
   * @access	public
   * @return string
   */
    public function getLocalName()
	{
    	return RDFUtil::guessName($this->uri);
  	}

  /**
   * Dumps resource.
   * @access	public
   * @return string
   */
	public function toString()
	{
		return 'RDFResource("' . $this->uri .'")';
	}

  /**
   * Checks if the resource equals another resource.
   * Two resources are equal, if they have the same URI
   *
   * @access	public
   * @param		object	resource $that
   * @return	boolean
   */
	public function equals($that)
	{
	    if ($this === $that) {
			return TRUE;
	    }
		
	    if ($that === NULL || is_a($that, 'RDFResource') !== TRUE) {
			return FALSE;
	    }
		
		return $this->getURI() === $that->getURI();
	}
	
    /**
    *   Doing string magic in PHP5
    *   @return string String representation of this RDFResource
    */
    public function __toString()
    {
        return $this->toString();
    }
}

?>