<?php
// ----------------------------------------------------------------------------------
// Class: InfRule
// ----------------------------------------------------------------------------------

/**
 * This class represents a single rule in a RDFS inference model.
 * It primary constists of a trigger and an entailment.
 * In the forward-chaining mode (RDFSFModel) a statement is checked, 
 * if it satisfies the trigger. If it does, a new statement is returned.
 * In the backward-chaining mode (RDFSBModel) a find-query is checked 
 * with the entailment. If this entailment could satify the find-query, 
 * a new find-query is returned, that searches for statements that 
 * satisfy the trigger of this rule.
 * 
 * @version  $Id: InfRule.php 290 2006-06-22 12:23:24Z tgauss $
 * @author Daniel Westphal <mail at d-westphal dot de>

 *
 * @package infModel
 * @access	public
 **/
 
class InfRule 
{
	
	/**
	* Array, that hold the trigger subject in key ['s'], the trigger 
	* predicate in ['p'], and the trigger object in ['o'].
	* The array values can be NULL to match anything or be a node that 
	* has to be matched.
	*
	* @var		array
	* @access	private
	*/
	private $trigger;

	/**
	* Array, that hold the entailment subject in key ['s'], the 
	* entailment predicate in ['p'], and the entailment object in ['o'].
	* The array values can be a node that will be inserted in the 
	* returning statement, or INF_TOK_SUBJECT to insert the subject,INF_TOK_PREDICATE to insert 
	* the predicate, or '<o>' to insert the object of the checked statement
	* to this position in the new returned statement.
	*
	* @var		array
	* @access	private
	*/	
 	private $entailment;
	
	
	
   /**
    * Constructor
	* 
    * 
	* @access	public
    */	 	
 	public function __construct()
 	{
		//initialising vars
		$this->trigger     = array();
		$this->entailment  = array();
 	}
 	
 	/**
	* Sets the trigger of this rule
	* The values can be NULL to match anything or be a node that has to 
	* be matched.
	*
	* @param	object RDFNode OR NULL	$nSubject
   	* @param	object RDFNode OR NULL	$nPredicate
   	* @param	object RDFNode OR NULL	$nObject
	* @access	public
	* @throws	PhpError
	*/	
 	public function setTrigger(RDFNode $nSubject = NULL, RDFNode $nPredicate = NULL, RDFNode $nObject = NULL)
 	{
 		//set the trigger
		$this->trigger['s'] = $nSubject;
		$this->trigger['p'] = $nPredicate;
		$this->trigger['o'] = $nObject;		
 	} 
	
 	/**
	* Sets the entailment of this rule
	* The values can be NULL to match anything or be a node that has to 
	* be matched.
	*
	* @param	object RDFNode OR NULL	$nSubject
   	* @param	object RDFNode OR NULL	$nPredicate
   	* @param	object RDFNode OR NULL	$nObject
	* @access	public
	* @throws	PhpError
	*/
	public function setEntailment($nSubject, $nPredicate, $nObject)
	{
		$this->entailment['s']  = $nSubject;	
		$this->entailment['p']  = $nPredicate;
		$this->entailment['o']  = $nObject;
	}
	
 	/**
	* Checks, if the statement satisfies the trigger.
	*
   	* @param	object Statement 
	* @return 	boolean
	* @access	public
	* @throws	PhpError
	*/
 	public function checkTrigger(Statement $statement)
 	{
 		// for each element, check if it equals the proper statement's element
 		// or it's NULL
		if (($this->trigger['s'] ===  NULL || 
		     $this->trigger['s']->equals($statement->getSubject())) !== TRUE) {
			return FALSE;
		} elseif (($this->trigger['p'] ===  NULL || 
		     $this->trigger['p']->equals($statement->getPredicate())) !== TRUE) {
			return FALSE;
		} elseif (($this->trigger['o'] ===  NULL ||
		     $this->trigger['o']->equals($statement->getObject())) !== TRUE) {
			return FALSE;
		} else {
			// if all are TRUE, return TRUE
			return TRUE;
		}
 	}
 
 	/**
	* Checks, if this rule could entail a statement that matches
	* a find of $nSubject,$nPredicate,$nObject.
	*
   	* @param	RDFNode		$nSubject
	* @param	RDFNode		$nPredicate
	* @param	RDFNode		$nObject
	* @return 	boolean
	* @access	public
	* @throws	PhpError
	*/ 	
 	public function checkEntailment (RDFNode $nSubject = NULL, RDFNode $nPredicate = NULL, RDFNode $nObject = NULL)
 	{
		// returns TRUE if ALL 3 elements are NULL or match the entailment equivalent
		return
			(
				$nSubject ===  NULL ||
				!is_a($this->entailment['s'],'RDFNode') ||
				$this->entailment['s']->equals($nSubject)
			) && (
				$nPredicate ===  NULL ||
				!is_a($this->entailment['p'],'RDFNode') ||
				$this->entailment['p']->equals($nPredicate)
			) && (				 			
				$nObject ===  NULL ||
				!is_a($this->entailment['o'],'RDFNode') ||
				$this->entailment['o']->equals($nObject)
			);
	}
	
 	/**
	 * Returns a infered InfStatement by evaluating the statement with 
	 * the entailment rule.
	 *
   	 * @param	object Statement 
	 * @return 	object InfStatement
	 * @access	public
	 * @throws	PhpError
	 */
 	public function entail(Statement $statement)
 	{
 		//if the entailment's subject is INF_TOK_SUBJECT,INF_TOK_PREDICATE,or <o>, put the statements 
 		//subject,predicate,or object into the subject of the 
 		//entailed statement. If the entailment's subject is a node, 
 		//add that node to the statement.	
	 	$entailedSubject = $this->entailment['s'];
		if ($entailedSubject === INF_TOK_SUBJECT) {
			$entailedSubject = $statement->getSubject();
		} elseif ($entailedSubject === INF_TOK_PREDICATE) {
			$entailedSubject = $statement->getPredicate();
		} elseif ($entailedSubject === INF_TOK_OBJECT) {
			$entailedSubject = $statement->getObject();
		}
		
 		//if the entailment's predicate is INF_TOK_SUBJECT, INF_TOK_PREDICATE, or INF_TOK_OBJECT, put the 
 		//statements subject,predicate,or object into the predicate of 
 		//the entailed statement. If the entailment's predicate is a node, 
 		//add that node to the statement.			
		$entailedPredicate = $this->entailment['p'];
		if ($entailedPredicate === INF_TOK_SUBJECT) {
			$entailedPredicate = $statement->getSubject();
		} elseif ($entailedPredicate === INF_TOK_PREDICATE) {
			$entailedPredicate = $statement->getPredicate();
		} elseif ($entailedPredicate === INF_TOK_OBJECT) {
			$entailedPredicate = $statement->getObject();
		}
		
 		//if the entailment's object is INF_TOK_SUBJECT, INF_TOK_PREDICATE, or INF_TOK_OBJECT, put the 
 		//statements subject,predicate,or object into the object of 
 		//the entailed statement. If the entailment's object is a node,
 		//add that node to the statement.			
		$entailedObject = $this->entailment['o'];
		if ($entailedObject === INF_TOK_SUBJECT) {
				$entailedObject = $statement->getSubject();
		} elseif ($entailedObject === INF_TOK_PREDICATE) {
				$entailedObject = $statement->getPredicate();
		} elseif ($entailedObject === INF_TOK_OBJECT) {
				$entailedObject = $statement->getObject();
		}
		
		//return the infered statement
		return new InfStatement($entailedSubject, $entailedPredicate, $entailedObject);
 	}
 	
 	/**
	* Returns a find-query that matches statements, whose entailed 
	* statements would match the supplied find query.
	*
   	* @param	RDFNode OR null $nSubject
   	* @param	RDFNode OR null $nPredicate
   	* @param	RDFNode OR null $nObject
	* @return 	array
	* @access	public
	* @throws	PhpError
	*/  	 	
 	public function getModifiedFind(RDFNode $nSubject = NULL, RDFNode $nPredicate = NULL, RDFNode $nObject = NULL)
 	{			
 		$findSubject    = $this->trigger['s'];
 		$findPredicate  = $this->trigger['p'];
 		$findObject     = $this->trigger['o'];
 		
 		if ($this->entailment['s'] === INF_TOK_SUBJECT) {
 			 	$findSubject    = $nSubject;
		} elseif ($this->entailment['s'] === INF_TOK_PREDICATE) {
 			 	$findPredicate  = $nSubject;
		} elseif ($this->entailment['s'] === INF_TOK_OBJECT) {
			 	$findObject     = $nSubject;
 		}
 		
 		if ($this->entailment['p'] === INF_TOK_SUBJECT) {
		 	$findSubject    = $nPredicate;
		} elseif ($this->entailment['p'] === INF_TOK_PREDICATE) {
		 	$findPredicate  = $nPredicate;
		} elseif ($this->entailment['p'] === INF_TOK_OBJECT) {
		 	$findObject     = $nPredicate;
 		}
 		
 		if ($this->entailment['o'] === INF_TOK_SUBJECT) {
		 	$findSubject    = $nObject;
		} elseif ($this->entailment['o'] === INF_TOK_PREDICATE) {
		 	$findPredicate  = $nObject;
		} elseif ($this->entailment['o'] === INF_TOK_OBJECT) {
		 	$findObject     = $nObject;
 		}
		
 		return array('s' => $findSubject,
			 	     'p' => $findPredicate,
			 		 'o' => $findObject);	
 	}
 	
 	public function getTrigger()
 	{
 		return $this->trigger;
 	}
 	
 	public function getEntailment()
 	{
 		return $this->entailment;
 	}
}
?>