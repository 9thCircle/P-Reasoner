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
	* @param	object Node OR NULL	$subject
   	* @param	object Node OR NULL	$predicate
   	* @param	object Node OR NULL	$object
	* @access	public
	* @throws	PhpError
	*/	
 	public function setTrigger(Node $subject = NULL, Node $predicate = NULL, Node $object = NULL)
 	{
 		//set the trigger
		$this->trigger['s'] = $subject;
		$this->trigger['p'] = $predicate;
		$this->trigger['o'] = $object;		
 	} 
	
 	/**
	* Sets the entailment of this rule
	* The values can be NULL to match anything or be a node that has to 
	* be matched.
	*
	* @param	object Node OR NULL	$subject
   	* @param	object Node OR NULL	$predicate
   	* @param	object Node OR NULL	$object
	* @access	public
	* @throws	PhpError
	*/
	public function setEntailment($subject, $predicate, $object)
	{
		/* This check is not really needed.
		
		if(!is_a($object,'Node') && !ereg('<[spo]>', $object)) 
			trigger_error(RDFAPI_ERROR . '(class: Infrule; method: 
				setEntailment): $object has to be ' . INF_TOK_SUBJECT . ',' . INF_TOK_PREDICATE . ',or <o> or of class Node'
				, E_USER_ERROR);
		*/
		
		
		$this->entailment['s']  = $subject;	
		$this->entailment['p']  = $predicate;
		$this->entailment['o']  = $object;
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
		     ($this->trigger['o'] === ':r' && is_a($statement->getObject(), 'Literal') !== TRUE) ||
		     $this->trigger['o']->equals($statement->getObject())) !== TRUE) {
			return FALSE;
		} else {
			// if all are TRUE, return TRUE
			return TRUE;
		}
 	}
 
 	/**
	* Checks, if this rule could entail a statement that matches
	* a find of $subject,$predicate,$object.
	*
   	* @param	object Statement 
	* @return 	boolean
	* @access	public
	* @throws	PhpError
	*/ 	
 	public function checkEntailment (Node $subject = NULL, Node $predicate = NULL, Node $object = NULL)
 	{
		//true, if $subject is null, the entailment's subject matches
		//anything, or the $subject equals the entailment-subject.
 		$matchesS=	$subject ===  NULL ||
		 			!is_a($this->entailment['s'],'Node') ||
		 			$this->entailment['s']->equals($subject);

		//true, if $predicate is null, the entailment's predicate matches 
		//anything, or the $predicate equals the entailment-predicate.		 			
		 $matchesP=	$predicate ===  NULL ||
		 			!is_a($this->entailment['p'],'Node') ||
		 			$this->entailment['p']->equals($predicate);

		//true, if $object is null, the entailment's object matches 
		//anything, or the $object equals the entailment-object.		 					 			
		$matchesO=	$object ===  NULL ||
		 			!is_a($this->entailment['o'],'Node') ||
		 			$this->entailment['o']->equals($object);
  		
 		//returns true, if ALL are true
 		return $matchesS && $matchesP && $matchesO;
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
	 	switch ($this->entailment['s']) {
			case INF_TOK_SUBJECT:
				$entailedSubject=$statement->getSubject();
			break;
			case INF_TOK_PREDICATE:
				$entailedSubject=$statement->getPredicate();
			break;	
			case INF_TOK_OBJECT:
				$entailedSubject=$statement->getObject();
			break;
			default:
				$entailedSubject=$this->entailment['s'];
		}
		
 		//if the entailment's predicate is INF_TOK_SUBJECT, INF_TOK_PREDICATE, or INF_TOK_OBJECT, put the 
 		//statements subject,predicate,or object into the predicate of 
 		//the entailed statement. If the entailment's predicate is a node, 
 		//add that node to the statement.			
		switch ($this->entailment['p']) {
			case INF_TOK_SUBJECT:
				$entailedPredicate=$statement->getSubject();
			break;
			case INF_TOK_PREDICATE:
				$entailedPredicate=$statement->getPredicate();
			break;	
			case INF_TOK_OBJECT:
				$entailedPredicate=$statement->getObject();
			break;
			default:
				$entailedPredicate=$this->entailment['p'];
		}
		
 		//if the entailment's object is INF_TOK_SUBJECT, INF_TOK_PREDICATE, or INF_TOK_OBJECT, put the 
 		//statements subject,predicate,or object into the object of 
 		//the entailed statement. If the entailment's object is a node,
 		//add that node to the statement.			
		switch ($this->entailment['o']) {
			case INF_TOK_SUBJECT:
				$entailedObject=$statement->getSubject();
			break;
			case INF_TOK_PREDICATE:
				$entailedObject=$statement->getPredicate();
			break;	
			case INF_TOK_OBJECT:
				$entailedObject=$statement->getObject();
			break;
			default:
				$entailedObject=$this->entailment['o'];
		}
		
		//return the infered statement
		return new InfStatement($entailedSubject, $entailedPredicate, $entailedObject);
 	}
 	
 	/**
	* Returns a find-query that matches statements, whose entailed 
	* statements would match the supplied find query.
	*
   	* @param	Node OR null $subject
   	* @param	Node OR null $predicate
   	* @param	Node OR null $object
	* @return 	array
	* @access	public
	* @throws	PhpError
	*/  	 	
 	public function getModifiedFind(Node $subject = NULL, Node $predicate = NULL, Node $object = NULL)
 	{			
 		$findSubject    = $this->trigger['s'];
 		$findPredicate  = $this->trigger['p'];
 		$findObject     = $this->trigger['o'];
 		
 		switch ($this->entailment['s']) {
 			case INF_TOK_SUBJECT:
 			 	$findSubject    = $subject;
		 	break;
 			case INF_TOK_PREDICATE:
 			 	$findPredicate  = $subject;
		 	break;	
		 	case INF_TOK_OBJECT:
			 	$findObject     = $subject;
		 	break;
 		}
 			
 		switch ($this->entailment['p']) {
 			case INF_TOK_SUBJECT:
 			 	$findSubject    = $predicate;
		 	break;
 			case INF_TOK_PREDICATE:
 			 	$findPredicate  = $predicate;
		 	break;	
		 	case INF_TOK_OBJECT:
			 	$findObject     = $predicate;
	 		break;
 		}
 		
 		switch ($this->entailment['o']) {
 			case INF_TOK_SUBJECT:
 			 	$findSubject    = $object;
		 	break;
 			case INF_TOK_PREDICATE:
 			 	$findPredicate  = $object;
		 	break;	
		 	case INF_TOK_OBJECT:
			 	$findObject     = $object;
		 	break;
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