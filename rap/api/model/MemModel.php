<?php

// ----------------------------------------------------------------------------------
// Class: MemModel
// ----------------------------------------------------------------------------------

/**
* A MemModel is an RDF Model, which is stored in the main memory.
* This class provides methods for manipulating MemModels.
*
*
*
* @version  $Id: MemModel.php 425 2007-05-01 12:59:18Z cweiske $
* @author Chris Bizer <chris@bizer.de>
* @author Gunnar AAstrand Grimnes <ggrimnes@csd.abdn.ac.uk>
* @author Radoslaw Oldakowski <radol@gmx.de>
* @author Daniel Westphal <mail@d-westphal.de>
* @author Tobias Gauß <tobias.gauss@web.de>
*
* @package model
* @access	public
*/

class MemModel extends Model
{
	/**
	* Triples of the MemModel
	* @var		array
	* @access	public
	*/
	public $triples = array();
	
	/**
	* Array containing the search indices
	* @var		array['INDEX_TYPE'][]['label'][]['PosInModel']
	*
	* @access   private
	*/
	protected $indexArr ;
	
	/**
	* depending on which index is used this variable is -1,0,1,2 or 3
	*
	* -1 : no index
	*  0 : default indices over subject, predicate, object separate
	*  1 : index over subject+predicate+object
	*  2 : index over subject+predicate
	*  3 : index over subject+object
	*
	* @var		int
	* @access	private
	*/
	protected $indexed;
	
	/**
	* Array of namespaces
	*
	* @var     array
	* @access	private
	*/
	protected $parsedNamespaces = array();
	
	
	
	/**
	* Constructor
	* You can supply a base_uri
	*
	* @param string $baseURI
	* @access	public
	*/
	public function MemModel($baseURI = NULL)
	{
		$this->setBaseURI($baseURI);
		$this->indexed = INDEX_TYPE;
	}

	/**
	 * Set a base URI for the MemModel.
	 * Affects creating of new resources and serialization syntax.
	 * If the URI doesn't end with # : or /, then a # is added to the URI.
	 * @param	string	$uri
	 * @access	public
	 */
	public function setBaseURI($uri)
	{
		// if URI does not end with # : / \ adds #
		if (strlen($uri) > 0) {
			$c = substr($uri, strlen($uri) - 1, 1);
			if (($c === '#' || $c === ':' || $c === '/' || $c === '\\')) {
				$uri .= '#';
			}
		}
		$this->baseURI = $uri;
	}
	
	/**
	 * Number of triples in the MemModel
	 *
	 * @return	integer
	 * @access	public
	 */
	public function size()
	{
		return count($this->triples);
	}
	
	/**
	 * Checks if MemModel is empty.
	 *
	 * @return	boolean
	 * @access	public
	 */
	function isEmpty()
	{
		return count($this->triples) === 0;
	}
	
	/**
	* Adds a new triple to the MemModel without checking if the statement is already in the MemModel.
	* So if you want a duplicate free MemModel use the addWithoutDuplicates() function (which is slower then add())
	*
	* @param		object Statement	$statement
	* @access	public
	* @throws	PhpError
	*/
	public function add(Statement $statement)
	{
		if ($this->indexed !== -1) {
			$this->triples[] = $statement;
			end($this->triples);
			$k=key($this->triples);
			if($this->indexed === 0) {
				// index over S
				$this->indexOpr($statement, $k, 4, 1);
				// index over P
				$this->indexOpr($statement, $k, 5, 1);
				// index over O
				$this->indexOpr($statement, $k, 6, 1);
			} else {
				$this->indexOpr($statement, $k, $this->indexed, 1);
			}

		} else {
			$this->triples[] = $statement;
		}
	}
	
	/**
	* Checks if a new statement is already in the MemModel and adds the statement, if it is not in the MemModel.
	* addWithoutDuplicates() is significantly slower then add().
	* Retruns TRUE if the statement is added.
	* FALSE otherwise.
	*
	* @param	object Statement	$statement
	* @return    boolean
	* @access	public
	* @throws	PhpError
	*/
	function addWithoutDuplicates(Statement $statement)
	{
		if (!$this->contains($statement)) {
			$this->add($statement);
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/**
	* Removes the triple from the MemModel.
	* TRUE if the triple is removed.
	* FALSE otherwise.
	*
	* @param		object Statement	$statement
	* @return    boolean
	* @access	public
	* @throws	PhpError
	*/
	function remove(Statement $statement)
	{
		if($this->indexed == -1){
			$pass=false;
			foreach($this->triples as $key => $value) {
				if ($this->matchStatement($value, $statement->getSubject(), $statement->getPredicate(), $statement->getObject())) {
					unset($this->triples[$key]);
					$pass= true;
				}
			}
			return $pass;
		} else {
			$k = NULL;
			if($this->indexed==0){
				$pass  = FALSE;
				$del   = FALSE;
				while($del!=-1) {
					// index over S
					$del=$this->indexOpr($statement,$k,4,0);
					// index over P
					$this->indexOpr($statement,$k,5,0);
					// index over O
					$this->indexOpr($statement,$k,6,0);
					if($del!=-1){
						unset($this->triples[$del]);
						$pass=true;
					}
				}
				return $pass;
			}else{
				$pass=false;
				$del=false;
				while($del!=-1){
					$del=$this->indexOpr($statement, $k, $this->indexed, 0);
					if($del!=-1){
						unset($this->triples[$del]);
						$pass=true;
					}
				}
				return $pass;
			}
		}
	}

	/**
	* Short Dump of the MemModel.
	*
	* @access	public
	* @return	string
	*/
	public function toString()
	{
		return 'MemModel[baseURI=' . $this->getBaseURI() . ';  size=' . $this->size() . ']';
	}

	/**
	* Dumps of the MemModel including all triples.
	*
	* @access	public
	* @return	string
	*/
	public function toStringIncludingTriples()
	{
		$dump = $this->toString() . chr(13);
		foreach ($this->triples as $value) {
			$dump .= $value->toString() . chr(13);
		}
		return $dump;
	}
	
	/**
	* Writes the RDF serialization of the MemModel as HTML.
	*
	* @access	public
	*/
	public function writeAsHtml()
	{
		require_once RDFAPI_INCLUDE_DIR.PACKAGE_SYNTAX_RDF;
		$ser = new RdfSerializer();
		$rdf =& $ser->serialize($this);
		$rdf = htmlspecialchars($rdf, ENT_QUOTES);
		$rdf = str_replace(' ', '&nbsp;', $rdf);
		$rdf = nl2br($rdf);
		echo $rdf;
	}

	/**
	* Writes the RDF serialization of the MemModel as HTML table.
	*
	* @access	public
	*/
	public function writeAsHtmlTable()
	{
		// Import Package Utility
		include_once RDFAPI_INCLUDE_DIR.PACKAGE_UTILITY;
		RDFUtil::writeHTMLTable($this);
	}


	/**
	* Writes the RDF serialization of the MemModel as HTML table.
	*
	* @access	public
	* @return	string
	*/
	public function writeRdfToString()
	{
		// Import Package Syntax
		include_once RDFAPI_INCLUDE_DIR.PACKAGE_SYNTAX_RDF;
		$ser = new RdfSerializer();
		$rdf =& $ser->serialize($this);
		return $rdf;
	}


	/**
	* Saves the RDF,N3 or N-Triple serialization of the MemModel to a file.
	* You can decide to which format the model should be serialized by using a
	* corresponding suffix-string as $type parameter. If no $type parameter
	* is placed this method will serialize the model to XML/RDF format.
	* Returns FALSE if the MemModel couldn't be saved to the file.
	*
	* @access	public
	* @param 	string 	$filename
	* @param 	string 	$type
	* @throws   PhpError
	* @return	boolean
	*/
	public function saveAs($filename, $type ='rdf')
	{
		// get suffix and create a corresponding serializer
		if ($type === 'rdf') {
			// Import Package Syntax
			include_once RDFAPI_INCLUDE_DIR.PACKAGE_SYNTAX_RDF;
			$ser = new RdfSerializer();
		}elseif ($type === 'nt') {
			// Import Package Syntax
			include_once RDFAPI_INCLUDE_DIR.PACKAGE_SYNTAX_N3;
			$ser = new NTripleSerializer();
		}elseif ($type === 'n3') {
			// Import Package Syntax
			include_once RDFAPI_INCLUDE_DIR.PACKAGE_SYNTAX_N3;
			$ser = new N3Serializer();
		}else {
			print 'Serializer type not properly defined. Use the strings "rdf","n3" or "nt".';
			return false;
		};
		
		return $ser->saveAs($this, $filename);
	}


	/**
	* Tests if the MemModel contains the given triple.
	* TRUE if the triple belongs to the MemModel;
	* FALSE otherwise.
	*
	* @param	object Statement	&$statement
	* @return	boolean
	* @access	public
	*/
	public function contains(Statement $statement)
	{
		// no index ->linear contains
		if ($this->indexed === -1){
			foreach($this->triples as $value) {
				if ($value->equals($statement)) {
					return TRUE;
				}
			}
			return FALSE;
		}
		return ($this->indexed === 0) ?
			$this->containsIndex($statement, 4) :
			$this->containsIndex($statement, $this->indexed);
	}
	
	/**
	* Determine if all of the statements in a model are also contained in this MemModel.
	* True if all of the statements in $model are also contained in this MemModel and false otherwise.
	*
	* @param	object Model	&$model
	* @return	boolean
	* @access	public
	*/
	public function containsAll(Model $model)
	{
		if (is_a($model, 'MemModel')) {
			foreach ($model->triples as $statement) {
				if (!$this->contains($statement)) {
					return FALSE;
				}
			}
			return TRUE;

		} elseif (is_a($model, 'DbModel')) {
			return $model->containsAll($this);
		}
		
		$errmsg = RDFAPI_ERROR . '(class: MemModel; method: containsAll): MemModel or DbModel expected.';
		trigger_error($errmsg, E_USER_ERROR);
	}
	
	/**
	* Determine if any of the statements in a model are also contained in this MemModel.
	* True if any of the statements in $model are also contained in this MemModel and false otherwise.
	*
	* @param	object Model	&$model
	* @return	boolean
	* @access	public
	*/
	public function containsAny(Model $model)
	{
		if (is_a($model, 'MemModel')) {
			foreach($model->triples as $modelStatement) {
				if($this->contains($modelStatement)) {
					return TRUE;
				}
			}
			return FALSE;
		} elseif (is_a($model, 'DbModel')) {
			return $model->containsAny($this);
		}
		$errmsg = RDFAPI_ERROR . '(class: MemModel; method: containsAll): MemModel or DbModel expected.';
		trigger_error($errmsg, E_USER_ERROR);
	}


	/**
	* Builds a search index for the statements in the MemModel.
	* The index is used by the find(),contains(),add() and remove() functions.
	* Performance example using a model with 43000 statements on a Linux machine:
	* Find without index takes 1.7 seconds.
	* Indexing takes 1.8 seconds.
	* Find with index takes 0.001 seconds.
	* So if you want to query a model more then once, build a index first.
	* The defaultindex is indices over subject, predicate, object seperate.
	*
	* mode = 0    : indices over subject,predicate,object (default)
	* mode = 1	 : index over subject+predicate+object
	* mode = 2 	 : index over subject+predicate
	* mode = 3	 : index over subject+object
	*
	* @param     int $mode
	* @access	public
	*/
	public function index($mode)
	{
		$this->indexArr=array();
		switch($mode){
			// unset indices
			case -1:
			$this->indexed=-1;
			unset($this->indexArr);
			break;
			// index over SPO
			case 0:
			$this->indexed=0;
			foreach($this->triples as $k => $t) {
				// index over S
				$this->indexOpr($t,$k,4,1);
				// index over P
				$this->indexOpr($t,$k,5,1);
				// index over O
				$this->indexOpr($t,$k,6,1);
			}
			break;
			default:
			$this->indexed=$mode;
			foreach($this->triples as $k => $t) {
				$this->indexOpr($t,$k,$this->indexed,1);
			}
			break;
		}
	}
	
	/**
	* Returns 	true if there is an index, false if not.
	*
	* @return	boolean
	* @access	public
	*/
	public function isIndexed()
	{
		return $this->indexed != -1;
	}
	
	/**
	* Returns the indextype:
	* -1 if there is no index, 0 if there are indices over S,P,O(separate),
	* 1 if there is an index over SPO, 2 if there is an index over SP and 3 if
	* there is an index over SO.
	*
	* @return int
	* @access public
	*
	*/
	public function getIndexType()
	{
		return $this->indexed;
	}

	/**
	* General method to search for triples.
	* NULL input for any parameter will match anything.
	* Example:  $result = $m->find( NULL, NULL, $node );
	* Finds all triples with $node as object.
	* Returns an empty MemModel if nothing is found.
	*
	* @param	object RDFNode	$subject
	* @param	object RDFNode	$predicate
	* @param	object RDFNode	$object
	* @return	object MemModel
	* @access	public
	* @throws	PhpError
	*/
	public function find(RDFResource $subject = NULL, RDFResource $predicate = NULL, RDFResource $object = NULL)
	{
		$res = new MemModel($this->getBaseURI());
		$res->indexed = -1;
		
		if($this->isEmpty()) {
			return $res;
		}
		
		if($subject === NULL && $predicate === NULL && $object === NULL) {
			return $this;
		}
		
		switch($this->indexed) {
			case 1:
			if($subject!=NULL && $predicate != NULL && $object != NULL){
				$pos=$subject->getLabel().$predicate->getLabel().$object->getLabel();
				return $this->findInIndex($pos,$subject,$predicate,$object,1);
			}else{
				break;
			}

			case 2:
			if($subject!=NULL && $predicate != NULL){
				$pos=$subject->getLabel().$predicate->getLabel();
				return $this->findInIndex($pos,$subject,$predicate,$object,2);
			}else{
				break;
			}

			case 3:
			if($subject!=NULL && $object != NULL){
				$pos=$subject->getLabel().$object->getLabel();
				return $this->findInIndex($pos,$subject,$predicate,$object,3);
			}else{
				break;
			}
			case 0:
			if($subject!= null){
				$pos=$subject->getLabel();
				return $this->findInIndex($pos,$subject,$predicate,$object,4);
			}
			if($predicate!= null){
				$pos=$predicate->getLabel();
				return $this->findInIndex($pos,$subject,$predicate,$object,5);
			}
			if($object!= null){
				$pos=$object->getLabel();
				return $this->findInIndex($pos,$subject,$predicate,$object,6);
			}
		}
		
		// if no index: linear search
		foreach($this->triples as $value) {
			if ($this->matchStatement($value, $subject, $predicate, $object))
			$res->add($value);
		}
		return $res;
	}
	
	/**
	* Method to search for triples using Perl-style regular expressions.
	* NULL input for any parameter will match anything.
	* Example:  $result = $m->find_regex( NULL, NULL, $regex );
	* Finds all triples where the label of the object node matches the regular expression.
	* Returns an empty MemModel if nothing is found.
	*
	* @param	string	$subject_regex
	* @param	string	$predicate_regex
	* @param	string	$object_regex
	* @return	object MemModel
	* @access	public
	*/
	public function findRegex($subject_regex, $predicate_regex, $object_regex)
	{
		$res = new MemModel($this->getBaseURI());

		if($this->size() === 0)
		return $res;
		
		if($subject_regex === NULL && $predicate_regex === NULL && $object_regex === NULL)
			return $this;

		foreach($this->triples as $value) {
			if (
			($subject_regex === NULL || preg_match($subject_regex, $value->subj->getLabel())) &&
			($predicate_regex === NULL || preg_match($predicate_regex, $value->pred->getLabel())) &&
			($object_regex === NULL || preg_match($object_regex, $value->obj->getLabel()))
			) $res->add($value);
		}
		
		return $res;
	}

	/**
	* Returns all tripels of a certain vocabulary.
	* $vocabulary is the namespace of the vocabulary inluding a # : / char at the end.
	* e.g. http://www.w3.org/2000/01/rdf-schema#
	* Returns an empty MemModel if nothing is found.
	*
	* @param	string	$vocabulary
	* @return	object MemModel
	* @access	public
	*/
	function findVocabulary($vocabulary)
	{
		if($this->size() === 0)
			return new MemModel();
		if(empty($vocabulary) === TRUE)
			return $this;

		$res = new MemModel($this->getBaseURI());
		if($this->indexed==0) {
			foreach($this->indexArr[5] as $key => $value){
				$pos=strpos($key,'#')+1;
				if(substr($key,0,$pos)==$vocabulary){
					for($i=1;$i<=$value[0];$i++){
						$res->add($this->triples[$value[$i]]);
					}
				}
			}
			return $res;
		} else {
			// Import Package Utility
			include_once(RDFAPI_INCLUDE_DIR.PACKAGE_UTILITY);
			foreach($this->triples as $value) {
				if (RDFUtil::getNamespace($value->getPredicate()) == $vocabulary)
				$res->add($value);
			}
			return $res;
		}
	}

	/**
	* Searches for triples and returns the first matching statement.
	* NULL input for any parameter will match anything.
	* Example:  $result = $m->findFirstMatchingStatement( NULL, NULL, $node );
	* Returns the first statement of the MemModel where the object equals $node.
	* Returns an NULL if nothing is found.
	* You can define an offset to search for. Default = 0
	*
	* @param	object RDFNode	$subject
	* @param	object RDFNode	$predicate
	* @param	object RDFNode	$object
	* @param	integer	$offset
	* @return	object Statement
	* @access	public
	*/
	public function findFirstMatchingStatement($subject, $predicate, $object, $offset = 0)
	{
		$currentOffset = 0;
		for($i = 0; $i <= $offset; $i++)
		{
			$res = $this->findFirstMatchOff($subject, $predicate, $object, $currentOffset);
			$currentOffset = $res + 1;
		}
		return $res !== -1 ? $this->triples[$res] : NULL;
	}
	
	/**
	* Searches for triples and returns the first matching statement from a given offset.
	* This method is used by the util/findIterator. NULL input for any parameter will match anything.
	* Example:  $result = $m->findFirstMatchingStatement( NULL, NULL, $node, $off );
	* Returns the position of the first statement of the MemModel where the object equals $node from the given
	* offset.
	* Returns an -1 if nothing is found.
	*
	* @param	object RDFNode	$subject
	* @param	object RDFNode	$predicate
	* @param	object RDFNode	$object
	* @param int         $off
	* @return	int
	* @access	public
	*/
	public function findFirstMatchOff(RDFResource $subject = NULL, RDFResource $predicate = NULL, RDFResource $object = NULL, $off = 0)
	{
		if ($subject === NULL && $predicate === NULL && $object === NULL) {
			foreach ($this->triples as $key => $statement) {
				if ($key >= $off) {
					return $key;
				}
			}
			return -1;
		}
		
		switch ($this->indexed) {
			case 1:
			if ($subject !== NULL && $predicate !== NULL && $object !== NULL){
				$pos=$subject->getLabel().$predicate->getLabel().$object->getLabel();
				return $this->findMatchIndex($pos, $subject, $predicate, $object, 1, $off);
			}else{
				break;
			}

			case 2:
			if ($subject !== NULL && $predicate !== NULL) {
				$pos=$subject->getLabel().$predicate->getLabel();
				return $this->findMatchIndex($pos, $subject, $predicate, $object, 2, $off);
			}else{
				break;
			}

			case 3:
			if ($subject !== NULL && $object !== NULL) {
				$pos=$subject->getLabel().$object->getLabel();
				return $this->findMatchIndex($pos, $subject, $predicate, $object, 3, $off);
			}else{
				break;
			}
			case 0:
			if ($subject!== NULL){
				$pos=$subject->getLabel();
				return $this->findMatchIndex($pos, $subject, $predicate, $object, 4, $off);
			}
			if ($predicate!== NULL){
				$pos=$predicate->getLabel();
				return $this->findMatchIndex($pos, $subject, $predicate, $object, 5, $off);
			}
			if ($object!== NULL){
				$pos=$object->getLabel();
				return $this->findMatchIndex($pos, $subject, $predicate, $object, 6, $off);
			}
			break;
		}
		// if no index: linear search
		foreach ($this->triples as $key => $value) {
			if ($this->matchStatement($value, $subject, $predicate, $object)) {
				if($off <= $key) {
					return $key;
				}
			}
		}
		return -1;
	}
	
	/**
	* Searches for triples and returns the number of matches.
	* NULL input for any parameter will match anything.
	* Example:  $result = $m->findCount( NULL, NULL, $node );
	* Finds all triples with $node as object.
	*
	* @param	object RDFNode	$subject
	* @param	object RDFNode	$predicate
	* @param	object RDFNode	$object
	* @return	integer
	* @access	public
	*/
	public function findCount(RDFResource $subject = NULL, RDFResource $predicate = NULL, RDFResource $object = NULL)
	{
		return $this->find($subject, $predicate, $object)->size();

	}
	
	/**
	* Perform an RDQL query on this MemModel.
	* This method returns an associative array of variable bindings.
	* The values of the query variables can either be RAP's objects (instances of RDFNode)
	* if $returnNodes set to TRUE, or their string serialization.
	*
	* @access	public
	* @param string $queryString
	* @param boolean $returnNodes
	* @return  array   [][?VARNAME] = object RDFNode  (if $returnNodes = TRUE)
	*      OR  array   [][?VARNAME] = string
	*
	*/
	public function rdqlQuery($queryString, $returnNodes = TRUE)
	{
		// Import RDQL Package
		include_once RDFAPI_INCLUDE_DIR.PACKAGE_RDQL;
		
		$parser = new RdqlParser();
		$parsedQuery =& $parser->parseQuery($queryString);
		
		// this method can only query this MemModel
		// if another model was specified in the from clause throw an error
		if (isset($parsedQuery['sources'][1])) {
			$errmsg = RDFAPI_ERROR . '(class: MemModel; method: rdqlQuery):';
			$errmsg .= ' this method can only query this MemModel';
			trigger_error($errmsg, E_USER_ERROR);
		}

		$engine = new RdqlMemEngine();
		$res =& $engine->queryModel($this, $parsedQuery, $returnNodes);
		
		return $res;
	}

	/**
	* Perform an RDQL query on this MemModel.
	* This method returns an RdqlResultIterator of variable bindings.
	* The values of the query variables can either be RAP's objects (instances of RDFNode)
	* if $returnNodes set to TRUE, or their string serialization.
	*
	* @access	public
	* @param string $queryString
	* @param boolean $returnNodes
	* @return  object RdqlResultIterator = with values as object RDFNode  (if $returnNodes = TRUE)
	*      OR  object RdqlResultIterator = with values as strings if (if $returnNodes = FALSE)
	*
	*/
	public function rdqlQueryAsIterator($queryString, $returnNodes = TRUE)
	{
		// Import RDQL Package
		include_once RDFAPI_INCLUDE_DIR.PACKAGE_RDQL;
		return new RdqlResultIterator($this->rdqlQuery($queryString, $returnNodes));
	}
	
	/**
	* General method to replace nodes of a MemModel.
	* NULL input for any parameter will match nothing.
	* Example:  $m->replace($node, NULL, $node, $replacement);
	* Replaces all $node objects beeing subject or object in
	* any triple of the MemModel with the $needle node.
	*
	* @param	object RDFNode	$subject
	* @param	object RDFNode	$predicate
	* @param	object RDFNode	$object
	* @param	object RDFNode	$replacement
	* @access	public
	* @throws	PhpError
	*/
	public function replace($subject, $predicate, $object, $replacement)
	{
		if (
		(!is_a($replacement, 'RDFNode')) ||
		(!is_a($subject, 'RDFResource') && $subject !== NULL) ||
		(!is_a($predicate, 'RDFResource') && $predicate !== NULL) ||
		(!is_a($object, 'RDFNode') && $object !== NULL)
		) {
			$errmsg = RDFAPI_ERROR . '(class: MemModel; method: replace): Parameters must be subclasses of RDFNode or NULL';
			trigger_error($errmsg, E_USER_ERROR);
		}

		if($this->size() === 0) {
			break;
		}
		foreach($this->triples as $key => $value) {
			if ($this->triples[$key]->subj->equals($subject)) {
				$this->triples[$key]->subj = $replacement;
			}
			if ($this->triples[$key]->pred->equals($predicate)) {
				$this->triples[$key]->pred = $replacement;
			}
			if ($this->triples[$key]->obj->equals($object)) {
				$this->triples[$key]->obj = $replacement;
			}
		}
		$this->index($this->indexed);
	}


	/**
	* Internal method that checks, if a statement matches a S, P, O or NULL combination.
	* NULL input for any parameter will match anything.
	*
	* @param	object Statement	$statement
	* @param	object RDFNode	$subject
	* @param	object RDFNode	$predicate
	* @param	object RDFNode	$object
	* @return	boolean
	* @access	private
	*/
	private function matchStatement(Statement $statement, $subject, $predicate, $object)
	{
		if(($subject != NULL) AND !($statement->subj->equals($subject)))
		return false;

		if($predicate != NULL && !($statement->pred->equals($predicate)))
		return false;

		if($object != NULL && !($statement->obj->equals($object)))
		return false;

		return true;
	}




	/**
	* Checks if two models are equal.
	* Two models are equal if and only if the two RDF graphs they represent are isomorphic.
	*
	* @access	public
	* @param		object	model &$that
	* @throws    phpErrpr
	* @return	boolean
	*/
	public function equals(Model $that)
	{
		if ($this->size() !== $that->size()) {
			return FALSE;
		}
		
		include_once(RDFAPI_INCLUDE_DIR. "util/ModelComparator.php");
		return ModelComparator::compare($this, $that);
	}
	
	/**
	* Returns a new MemModel that is the set-union of the MemModel with another model.
	* Duplicate statements are removed. If you want to allow duplicates, use addModel() which is much faster.
	*
	* The result of taking the set-union of two or more RDF graphs (i.e. sets of triples)
	* is another graph, which we will call the merge of the graphs.
	* Each of the original graphs is a subgraph of the merged graph. Notice that when forming
	* a merged graph, two occurrences of a given uriref or literal as nodes in two different
	* graphs become a single node in the union graph (since by definition they are the same
	* uriref or literal) but blank nodes are not 'merged' in this way; and arcs are of course
	* never merged. In particular, this means that every blank node in a merged graph can be
	* identified as coming from one particular graph in the original set of graphs.
	*
	* Notice that one does not, in general, obtain the merge of a set of graphs by concatenating
	* their corresponding N-triples documents and constructing the graph described by the merged
	* document, since if some of the documents use the same node identifiers, the merged document
	* will describe a graph in which some of the blank nodes have been 'accidentally' merged.
	* To merge Ntriples documents it is necessary to check if the same nodeID is used in two or
	* more documents, and to replace it with a distinct nodeID in each of them, before merging the
	* documents. (Not implemented yet !!!!!!!!!!!)
	*
	* @param	object Model	$model
	* @return	object MemModel
	* @access	public
	* @throws phpErrpr
	*
	*/
	public static function unite(Model $model)
	{
		if (is_a($model, 'MemModel')) {
            require_once RDFAPI_INCLUDE_DIR . 'util/StatementIterator.php';
			$stateIt = new StatementIterator($model);
			while($statement=$stateIt->next()) {
				$res->addWithoutDuplicates($statement);
			}
			return $res;
		} elseif (is_a($model, 'DbModel')) {
			$memModel =& $model->getMemModel();
			foreach($memModel->triples as $value) {
				$res->addWithoutDuplicates($value);
			}
			return $res;
		} else {
			$errmsg = RDFAPI_ERROR . '(class: MemModel; method: unite): MemModel or DbModel expected.';
			trigger_error($errmsg, E_USER_ERROR);
		}
	}

	/**
	* Returns a new MemModel that is the subtraction of another model from this MemModel.
	*
	* @param	object Model	$model
	* @return	object MemModel
	* @access	public
	* @throws phpErrpr
	*/
	public static function subtract(Model $model)
	{
		$res = $this;
		
		if (is_a($model, 'MemModel')) {
            require_once RDFAPI_INCLUDE_DIR . 'util/StatementIterator.php';
			$stateIt = new StatementIterator($model);
			while($statement = $stateIt->next()) {
				$res->remove($statement);
			}
			return $res;
		} elseif (is_a($model, 'DbModel')) {
			$memModel =& $model->getMemModel();
			foreach($memModel->triples as $value) {
				$res->remove($value);
			}
			return $res;
		} else {
			$errmsg = RDFAPI_ERROR . '(class: MemModel; method: subtract): MemModel or DbModel expected';
			trigger_error($errmsg, E_USER_ERROR);
		}
	}
	
	/**
	* Returns a new MemModel containing all the statements which are in both this MemModel and another.
	*
	* @param	object Model	$model
	* @return	object MemModel
	* @access	public
	* @throws phpErrpr
	*/
	public static function intersect(Model $model)
	{
		$res = new MemModel($this->getBaseURI());

		if (is_a($model, 'DbModel') || is_a($model, 'RDFSBModel'))
		{
			$memModel =& $model->getMemModel();
			foreach($memModel->triples as $value) {
				if ($this->contains($value))
				$res->add($value);
			}
			return $res;
		} elseif (is_a($model, 'MemModel')) {
			foreach($model->triples as $value) {
				if ($this->contains($value))
				$res->add($value);
			}
			return $res;
		} else {
			$errmsg = RDFAPI_ERROR . '(class: MemModel; method: intersect: MemModel or DbModel expected';
			trigger_error($errmsg, E_USER_ERROR);
		}
	}
	
	/**
	* Adds another model to this MemModel.
	* Duplicate statements are not removed.
	* If you don't want duplicates, use unite().
	* If any statement of the model to be added to this model contains a blankNode
	* with an identifier already existing in this model, a new blankNode is generated.
	*
	* @param	object Model	$model
	* @access	public
	* @throws phpErrpr
	*
	*/
	public function addModel(Model $model)
	{
		$blankNodes_tmp = array();

		if (is_a($model, 'MemModel')) {
			$stateIt = new StatementIterator($model);
			while($statement=$stateIt->next()) {
				$this->addStatementFromAnotherModel($statement, $blankNodes_tmp);
			}
			$this->addParsedNamespaces($model->getParsedNamespaces());
			$this->index($this->indexed);
		} elseif (is_a($model, 'DbModel')) {
			$memModel =& $model->getMemModel();
			foreach($memModel->triples as $value) {
				$this->addStatementFromAnotherModel($value, $blankNodes_tmp);
			}
			$this->index($this->indexed);
		} else {
			$errmsg = RDFAPI_ERROR . '(class: MemModel; method: addModel): MemModel or DbModel expected.';
			trigger_error($errmsg, E_USER_ERROR);
		}
	}
	
	/**
	* Reifies the MemModel.
	* Returns a new MemModel that contains the reifications of all statements of this MemModel.
	*
	* @access	public
	* @return	object	MemModel
	*/
	public static function reify()
	{
		$res = new MemModel($this->getBaseURI());
		
		while($statement = $this->getStatementIterator()->next()) {
			$pointer =& $statement->reify($res);
			$res->addModel($pointer);
		}
		
		return $res;
	}

	/**
	* Returns a StatementIterator for traversing the MemModel.
	* @access	public
	* @return	object	StatementIterator
	*/
	public static function getStatementIterator()
	{
		// Import Package Utility
        require_once RDFAPI_INCLUDE_DIR . 'util/StatementIterator.php';
		return new StatementIterator($this);
	}
	
	/**
	* Returns a FindIterator for traversing the MemModel.
	* @access	public
	* @return	object	FindIterator
	*/
	public static function findAsIterator(RDFNode $sub = NULL, RDFNode $pred = NULL, RDFNode $obj = NULL)
	{
		// Import Package Utility
        require_once RDFAPI_INCLUDE_DIR . 'util/FindIterator.php';
		$fi = new FindIterator($this, $sub, $pred, $obj);
		return $fi;
	}
	
	/**
	* Returns a FindIterator for traversing the MemModel.
	* @access	public
	* @return	object	FindIterator
	*/
	public static function iterFind(RDFNode $sub = NULL,  RDFNode$pred = NULL, RDFNode $obj = NULL)
	{
		// Import Package Utility
        require_once RDFAPI_INCLUDE_DIR . 'util/IterFind.php';
		$fi = new IterFind($this, $sub, $pred, $obj);
		return $fi;
	}
	
	/**
	* Returns the models namespaces.
	*
	* @author   Tobias Gau�<tobias.gauss@web.de>
	* @access   public
	* @return   Array
	*/
	public function getParsedNamespaces()
	{
		return count($this->parsedNamespaces) === 0 ?
			FALSE :
			$this->parsedNamespaces;
	}
	
	/**
	* Adds the namespaces to the model. This method is called by
	* the parser. !!!! addParsedNamespaces() not overwrites manual
	* added namespaces in the model !!!!
	*
	* @author   Tobias Gau�<tobias.gauss@web.de>
	* @access   public
	* @param    Array $newNs
	*/
	public function addParsedNamespaces($newNs)
	{
		if ($newNs) {
			$this->parsedNamespaces = $this->parsedNamespaces + $newNs;
		}
	}
	
	/**
	* Adds a namespace and prefix to the model.
	*
	* @author   Tobias Gau�<tobias.gauss@web.de>
	* @access   public
	* @param    String
	* @param    String
	*/
	public function addNamespace($prefix, $nmsp)
	{
		$this->parsedNamespaces[$nmsp] = $prefix;
	}
	
	/**
	* removes a single namespace from the model
	*
	* @author   Tobias Gau�<tobias.gauss@web.de>
	* @access   public
	* @param    String $nmsp
	*/
	public function removeNamespace($nmsp)
	{
		if(array_key_exists($nmsp, $this->parsedNamespaces) === TRUE) {
			unset($this->parsedNamespaces[$nmsp]);
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	/**
	* Close the MemModel and free up resources held.
	*
	* @access	public
	*/
	public function close()
	{
		$this->baseURI = $this->triples = NULL;
	}
	
	// =============================================================================
	// *************************** helper functions ********************************
	// =============================================================================
	/**
	* Checks if $statement is in index
	*
	* @param  int $ind
	* @param  Statement &$statement
	* @return boolean
	* @access private
	*/
	private function containsIndex(Statement $statement, $ind)
	{
		if ($ind === 4) {
			$sub   = $statement->getSubject();
			$pos   = $sub->getLabel();
		} elseif ($ind === 1) {
			$statement->getSPO($sub, $pred, $obj);
			$pos   = $sub->getLabel().$pred->getLabel().$obj->getLabel();
		} elseif ($ind === 2) {
			$sub   = $statement->getSubject();
			$pred  = $statement->getPredicate();
			$pos   = $sub->getLabel() . $pred->getLabel();
		} elseif ($ind === 3) {
			$sub   = $statement->getSubject();
			$obj   = $statement->getObject();
			$pos   = $sub->getLabel() . $obj->getLabel();
		}
		
		if (isset($this->indexArr[$ind][$pos]) !== TRUE) {
			return FALSE;
		}
		
		$index = $this->indexArr[$ind][$pos];
		foreach ($index as $value) {
			if ($this->triples[$value]->equals($statement)) {
				return TRUE;
			}
		}
		return FALSE;
	}
	
	/**
	* finds a statement in an index. $pos is the Position in the index
	* and $ind the adequate searchindex
	*
	* @param    String            $pos
	* @param    Object Subject    &$subject
	* @param    Object Predicate  &$predicate
	* @param    Object Object	 &$object
	* @param    int				 &ind
	* @return   MemModel          $res
	* @access   private
	*/
	private function findInIndex($pos, $subject, $predicate, $object, $ind)
	{
		$res = new MemModel($this->getBaseURI());
		$res->indexed = -1;
		if (isset($this->indexArr[$ind][$pos]) !== TRUE) {
			return $res;
		}
		foreach($this->indexArr[$ind][$pos] as $key =>$value) {
			$t = $this->triples[$value];
			if ($this->matchStatement($t, $subject, $predicate, $object)) {
				$res->add($t);
			}
		}
		return $res;
	}
	
	/**
	* adds/removes a statement into/from an index.
	* mode=0 removes the statement from the index;
	* mode=1 adds the statement into the index.
	* returns the statements position.
	*
	* @param Object Statement &$statement
	*	@param int              $k
	*	@param int              $ind
	* @param int				$mode
	* @return int             $k
	* @access private
	*/
	private function indexOpr(Statement $statement, $k, $ind, $mode)
	{
		// determine position in adequate index
		if ($ind === 1) {
			$s    = $statement->getSubject();
			$p    = $statement->getPredicate();
			$o    = $statement->getObject();
			$pos  = $s->getLabel() . $p->getLabel() . $o->getLabel();
		} elseif ($ind === 2) {
			$s    = $statement->getSubject();
			$p    = $statement->getPredicate();
			$pos  = $s->getLabel() . $p->getLabel();
		} elseif ($ind === 3) {
			$s    = $statement->getSubject();
			$o    = $statement->getObject();
			$pos  = $s->getLabel() . $o->getLabel();
		} elseif ($ind === 4) {
			$s    = $statement->getSubject();
			$pos  = $s->getLabel();
		} elseif ($ind === 5) {
			$p    = $statement->getPredicate();
			$pos  = $p->getLabel();
		} elseif ($ind === 6) {
			$o    = $statement->getObject();
			$pos  = $o->getLabel();
		}
		
		if ($mode === 1) {
			// add in Index
			if(isset($this->indexArr[$ind][$pos])){
				$this->indexArr[$ind][$pos][] = $k;
			}else{
				$this->indexArr[$ind][$pos][0] = $k;
			}
		} elseif ($mode === 0) {
			// remove from Index
			$subject    = $statement->getSubject();
			$predicate  = $statement->getPredicate();
			$object     = $statement->getObject();
			$k = -1;
			if (!isset($this->indexArr[$ind][$pos])) {
				return -1;
			}
			$num = count($this->indexArr[$ind][$pos]);
			foreach ($this->indexArr[$ind][$pos] as $key => $value) {
				$t = $this->triples[$value];
				if ($this->matchStatement($t, $subject, $predicate, $object)) {
					if($num === 1){
						unset($this->indexArr[$ind][$pos]);
					} else {
						unset($this->indexArr[$ind][$pos][$key]);
					}
					return $value;
				}
			}
		}
		
		return $k;
	}
	
	/**
	* finds next or previous matching statement.
	* Returns Position in model or -1 if there is no match.
	*
	*
	* @param	 String
	* @param     object   Subject
	* @param	 object	  Predicate
	* @param     object   Object
	* @param     integer
	* @param     integer
	* @return	 integer
	* @access	 private
	*/
	private function findMatchIndex($pos, &$s, &$p, &$o, $ind, $off)
	{
		if (isset($this->indexArr[$ind][$pos]) === FALSE) {
			return -1;
		}
		
		foreach ($this->indexArr[$ind][$pos] as $value) {
			if ($this->matchStatement($this->triples[$value], $s, $p, $o)) {
				if($off <= $value) {
					return $value;
				}
			}
		}
		
		return -1;
	}
}

?>