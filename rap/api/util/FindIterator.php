<?php

// ----------------------------------------------------------------------------------
// Class: FindIterator
// ----------------------------------------------------------------------------------

/**
 * Iterator for traversing statements matching a searchpattern. 
 * FindIterators are returned by model->findAsIterator()
 * Using a find iterator is significantly faster than using model->find() which returns
 * a new result model.
 * 
 * 
 * @version  $Id: FindIterator.php 268 2006-05-15 05:28:09Z tgauss $
 * @author Tobias Gauﬂ <tobias.gauss@web.de>
 *
 * @package utility
 * @access	public
 *
 */ 
 class FindIterator extends Object
 {

 	/**
	* Reference to the MemModel
	* @var		object MemModel
	* @access	private
	*/	
    protected $model;
    
 	/**
	* Current position
	* FindIterator does not use the build in PHP array iterator,
	* so you can use serveral iterators on a single MemModel.
	* @var		integer
	* @access	private
	*/	
    protected $position;
    
    /**
	* Searchpattern
	* 
	* @var		Object Subject,Predicate,Object
	* @access	private
	*/
	
    protected $nSubject;
    protected $nPredicate;
    protected $nObject;
	
	
   /**
    * Constructor
    *
    * @param	object	MemModel
    * @param    object  Subject
    * @param    object  Predicate
    * @param    object  Object
	* @access	public
    */
    public function __construct(Model $model, Node $sub = NULL, Node $pred = NULL, Node $obj = NULL)
	{
		$this->model       = $model;
		$this->nSubject    = $sub;
		$this->nPredicate  = $pred;
		$this->nObject     = $obj;
		$this->position    = -1;
	}
	
 	/**
    * Returns TRUE if there are more matching statements.
    * @return	boolean
    * @access	public  
    */
    public function hasNext()
	{
  		if($this->model->findFirstMatchOff($this->nSubject,$this->nPredicate,$this->nObject,$this->position+1)>-1){
  			return TRUE;
  		}else{
  			return FALSE;
  		}
    }

   
    /**
    * Returns the next matching statement.
    * @return	statement or NULL if there is no next matching statement.
    * @access	public  
    */
    public function next()
	{
  			$res = $this->model->findFirstMatchOff($this->nSubject,$this->nPredicate, $this->nObject, $this->position + 1);
  			if($res>-1) {
  				$this->position=$res;
  				return $this->model->triples[$res];
  			} else {
  				return NULL;
  			}		
    }
	
	/**
	 * Returns the current matching statement.
	 * @return	statement or NULL if there is no current matching statement.
	 * @access	public  
	 */
	function current()
	{
		if (($this->position >= -1) && (isset($this->model->triples[$this->position]))) {
			return $this->model->triples[$this->position];
		} else {
			return NULL;
		} 
	}
}

?>