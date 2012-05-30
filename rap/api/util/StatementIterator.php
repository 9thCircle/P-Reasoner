<?php

// ----------------------------------------------------------------------------------
// Class: StatementIterator
// ----------------------------------------------------------------------------------

/**
 * Iterator for traversing models. 
 * This class can be used for iterating forward and backward trough MemModels.
 * It should be instanced using the getIterator() method of a MemModel.
 * 
 * @version  $Id: StatementIterator.php 268 2006-05-15 05:28:09Z tgauss $
 * @author Daniel Westphal <mail at d-westphal dot de>
 * @author Chris Bizer <chris@bizer.de>
 *
 * @package utility
 * @access	public
 *
 */ 
 class StatementIterator extends Object
 {
 	/**
	* Reference to the MemModel
	* @var		object MemModel
	* @access	private
	*/	
    private $model;

 	/**
	* Current position
	* StatementIterator does not use the build in PHP array iterator,
	* so you can use serveral iterators on a single MemModel.
	* @var		integer
	* @access	private
	*/	
    private $position;
	
	
   /**
    * Constructor
    *
    * @param	object	MemModel
	* @access	public
    */
    function __construct(Model $model)
	{
		$this->triples = $model->triples;
		reset($this->triples);
		$this->position = -1;
	}
	
    /**
     * Returns TRUE if there are more statements.
     * @return	boolean
     * @access	public  
     */
	function hasNext()
	{
  		if ($this->position == -1) { 
  			if(current($this->triples) != NULL) {
  				return TRUE;	
  			} else {
  				return FALSE;
  			}
  		}
		
  		if (next($this->triples)!=NULL ) {
  			prev($this->triples);		
  			return TRUE;
		} else {
			end($this->triples);
			return FALSE;
		}
   }
	
	/**
	* Returns TRUE if the first statement has not been reached.
	* @return	boolean
	* @access	public  
	*/
	public function hasPrevious()
	{
		if (prev($this->triples) != NULL) 
		{
			next($this->triples);
			return TRUE;
		} else {
			reset($this->triples);
			return FALSE;
		}
	}
   
  /**
   * Returns the next statement.
   * @return	statement or NULL if there is no next statement.
   * @access	public  
   */
	public function next() {
		if ($this->position == -1) { 
			if ($return=current($this->triples)) {
				$this->position=key($this->triples);
				return $return;	
			} else {
				$this->position=key($this->triples);
				return NULL;
			}
		}
		
		if ($return=next($this->triples)) {
			$this->position=key($this->triples);
			return $return;
		} else {
			$this->position=key($this->triples);
			return NULL;
		}
	}

	/**
	 * Returns the previous statement.
	 * @return	statement or NULL if there is no previous statement.
	 * @access	public  
	 */
	public function previous()
	{
		if ($return = prev($this->triples)) {
			$this->position = key($this->triples);
			return $return;
		} else {
			$this->position = key($this->triples);
			return NULL;
		}   
	}

  /**
   * Returns the current statement.
   * @return	statement or NULL if there is no current statement.
   * @access	public  
   */
	public function current()
	{
  		if ($this->position==-1) {
			return NULL;
		}
		
  		if ($return=current($this->triples)) {
			return $return;
		} else {
			return NULL;
		}
	}
   
	/**
	 * Moves the pointer to the first statement.
	 * @return	void
	 * @access	public  
	 */
	public function moveFirst()
	{
		reset($this->triples);
		$this->position = 0;
	}
	
	/**
	 * Moves the pointer to the last statement.
	 * @return	void
	 * @access	public  
	 */
	public function moveLast()
	{
		end($this->triples);
		$this->position=key($this->triples);
	}
   
	/**
	 * Moves the pointer to a specific statement.
	 * If you set an off-bounds value, the position will be set to the last element
	 * @param 	integer
	 * @return	void
	 * @access	public  
	 */
	public function moveTo($position)
	{
		if ($position + 1 > count($this->triples)) {
			end($this->triples);
		} else {
			reset($this->triples);
			for ($i = 1; $i < $position; $i++) {
			   next($this->triples);
			}
		}
		$this->position = key($this->triples);
	}
	
	/**
	 * Returns the current position of the iterator.
	 * @return	integer
	 * @access	public  
	 */
	public function getCurrentPosition()
	{
		return key($this->triples);
	}
} 

?>