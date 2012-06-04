<?php

// ----------------------------------------------------------------------------------
// Class: Statement
// ----------------------------------------------------------------------------------

/**
 * An RDF statement.
 * In this implementation, a statement is not itself a resource. 
 * If you want to use a a statement as subject or object of other statements,
 * you have to reify it first.
 *  
 * @author Chris Bizer <chris@bizer.de>
 * @version  $Id: Statement.php 268 2006-05-15 05:28:09Z tgauss $
 * @package model
 */
class Statement extends RDFObject
{
	/**
	* Subject of the statement
	*
	* @var		object resource	
	* @access	private
	*/	
	public $subj = NULL;

	/**
	* Predicate of the statement
	*
	* @var		object resource	
	* @access	private
	*/		
    public $pred = NULL;
	
  	/**
	* Object of the statement
	*
	* @var		object node	
	* @access	private
	*/		
    public $obj = NULL;

  /**
   * The parameters to constructor are instances of classes and not just strings
   *
   * @param	object	RDFNode $subj
   * @param	object	RDFNode $pred
   * @param	object	RDFNode $obj
	* @throws	PhpError
   */
   public function __construct(RDFNode $subj, RDFNode $pred, RDFNode $obj)
   {
		if (is_a($subj, 'RDFResource') !== TRUE) {
			$errmsg = RDFAPI_ERROR . 
					  '(class: Statement; method: new): RDFResource expected as subject. Found: ' . get_class($subj);
			trigger_error($errmsg, E_USER_ERROR); 
		}
		if ((is_a($pred, 'RDFResource') && !is_a($pred, 'RDFBlankNode')) !== TRUE) {
			$errmsg = RDFAPI_ERROR . 
					  '(class: Statement; method: new): RDFResource expected as predicate, no blank node allowed.';
			trigger_error($errmsg, E_USER_ERROR); 
		}
		if ((is_a($obj, 'RDFResource') || is_a($obj, 'RDFLiteral')) !== TRUE) {
			$errmsg = RDFAPI_ERROR . 
					  '(class: Statement; method: new): RDFResource or RDFLiteral expected as object.';
			trigger_error($errmsg, E_USER_ERROR); 
		}
		
		$this->pred  = $pred;
		$this->subj  = $subj;
		$this->obj   = $obj;
	}

  /**
   * Returns the subject of the triple.
   * @access	public 
   * @return	object node
   */
	public function getSubject()
	{
		return $this->subj;
	}

  /**
   * Returns the predicate of the triple.
   * @access	public 
   * @return	object node
   */
	public function getPredicate()
	{
		return $this->pred;
	}

  /**
   * Returns the object of the triple.
   * @access	public 
   * @return	object node
   */
	public function getObject()
	{
		return $this->obj;
	}
	
	public function getSPO(&$s, &$p, &$o)
	{
		$s  = $this->subj;
		$p  = $this->pred;
		$o  = $this->obj;
	}
	
    /**
   * Retruns the hash code of the triple.	
   * @access	public 
   * @return string
   */
	public function hashCode()
	{
		return md5($this->subj->getLabel() . $this->pred->getLabel()  . $this->obj->getLabel());
	}

  /**
   * Dumps the triple.	
   * @access	public 
   * @return string
   */  
	public function toString()
	{ 
		return  'Triple(' . $this->subj->toString() . ', ' . $this->pred->toString() . ', ' . $this->obj->toString() . ')';
	}

  /**
   * Returns a toString() serialization of the statements's subject.
   *
   * @access	public 
   * @return	string 
   */  
	public function toStringSubject()
	{
		return $this->subj->toString();
	}

  /**
   * Returns a toString() serialization of the statements's predicate.
   *
   * @access	public 
   * @return	string 
   */  
	public function toStringPredicate()
	{
		return $this->pred->toString();
	}
	
  /**
   * Reurns a toString() serialization of the statements's object.
   *
   * @access	public 
   * @return	string 
   */  
	public function toStringObject()
	{
		return $this->obj->toString();
	}
	
  /**
   * Checks if two statements are equal.
   * Two statements are considered to be equal if they have the
   * same subject, predicate and object. A statement can only be equal 
   * to another statement object. 
   * @access	public 
   * @param		object	statement $that
   * @return	boolean 
   */
	public function equals($that)
	{
		return
			$this->subj->equals($that->getSubject())    &&
			$this->pred->equals($that->getPredicate())  &&
			$this->obj->equals($that->getObject());
	}

  /**
   * Compares two statements and returns integer less than, equal to, or greater than zero.
   * Can be used for writing sorting function for models or with the PHP function usort(). 
   *
   * @access	public 
   * @param		object	statement &$that
   * @return	boolean 
   */  
	public function compare($that)
	{
		return statementsorter($this, $that);
		// statementsorter function see below
	} 
      
	  
  /**
   * Reifies a statement.
   * Returns a new MemModel that is the reification of the statement.
   * For naming the statement's bNode a Model or bNodeID must be passed to the method.   
   *
   * @access	public 
   * @param		mixed	&$model_or_bNodeID
   * @return	object	model
   */
  public static function reify(&$model_or_bNodeID)
  {
		if (is_a($model_or_bNodeID, 'MemModel')) {
			// parameter is model
			$statementModel  = new MemModel($model_or_bNodeID->getBaseURI());
			$thisStatement   = new RDFBlankNode($model_or_bNodeID);
		} else {
			// parameter is bNodeID
			$statementModel  = new MemModel();
			$thisStatement   = &$model_or_bNodeID;
		}
		
		$RDFstatement  = new RDFResource(RDF_NAMESPACE_URI . RDF_STATEMENT);
		$RDFtype       = new RDFResource(RDF_NAMESPACE_URI . RDF_TYPE);
		$RDFsubject    = new RDFResource(RDF_NAMESPACE_URI . RDF_SUBJECT);
		$RDFpredicate  = new RDFResource(RDF_NAMESPACE_URI . RDF_PREDICATE);
		$RDFobject     = new RDFResource(RDF_NAMESPACE_URI . RDF_OBJECT);
		
		$statementModel->add(new Statement($thisStatement,  $RDFtype,       $RDFstatement));
		$statementModel->add(new Statement($thisStatement,  $RDFsubject,    $this->getSubject()));
		$statementModel->add(new Statement($thisStatement,  $RDFpredicate,  $this->getPredicate()));
		$statementModel->add(new Statement($thisStatement,  $RDFobject,     $this->getObject()));
		
		return $statementModel;
  }
} // end: Statement


/**
* Comparison function for comparing two statements.
* statementsorter() is used by the PHP function usort ( array array, callback cmp_function)
*
* @access	private 
* @param		object Statement	$a
* @param		object Statement	$b
* @return	integer less than, equal to, or greater than zero  
* @throws phpErrpr
*/
function statementsorter($a, $b)
{
	//Compare subjects
	$r = strcmp($a->getSubject()->getLabel(), $b->getSubject()->getLabel());
	if ($r !== 0) {
		return $r;
	}
	//Compare predicates
	$r = strcmp($a->getPredicate()->getURI(), $b->getPredicate()->getURI());
	if ($r !== 0) {
		return $r;
	}
	//Final resort, compare objects
	return strcmp($a->getObject()->toString(), $b->getObject()->toString());
}

?>