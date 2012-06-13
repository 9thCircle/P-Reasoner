<?php

// ----------------------------------------------------------------------------------
// Class: RDFObject
// ----------------------------------------------------------------------------------

/**
 * An abstract object.
 * Root object with some general methods, that should be overloaded. 
 * 
 *
 * @version  $Id: Object.php 295 2006-06-23 06:45:53Z tgauss $
 * @author Chris Bizer <chris@bizer.de>
 *
 * @abstract
 * @package utility
 *
 **/
class RDFObject
{
	//! Wether we are profiling
	protected /*. bool .*/     $isProfiling  = FALSE;
	//! Profiling data
	protected /*. Profile .*/  $profile      = NULL;
	
	
	//  =========
	//  Profiling
	//  *********
	
	
	/**
	 *	\brief		Returns TRUE, meaning that profiling is supported.
	 *	@return		bool
	 */
	public static function supportsProfiling()
	{
		return TRUE;
	}
	
	/**
	 *	\brief		Activate profiling.
	 *	@return		void
	 */
	public function startProfile()
	{
		if ($this->profile === NULL) {
			$this->profile = new Profile();
		}
		$this->isProfiling = TRUE;
	}
	
	/**
	 *	\brief		Deactivate profiling.
	 *	@return		void
	 */
	public function stopProfile()
	{
		$this->isProfiling = FALSE;
	}
	
	/**
	 *	\brief		Returns wether profiling is active.
	 *	@return		bool
	 */
	public function isProfiling()
	{
		return $this->isProfiling;
	}
	
	/**
	 *	\brief		Returns profiling information.
	 *	@return		Profile
	 */
	public function getProfile()
	{
		return $this->profile;
	}
	
	/**
	 *	\brief		Profiles last executed action.
	 *	@param		string		$action			Action name.
	 *	@param		bool		$result			Action result.
	 *	@param		float		$start			Start timestamp, in microseconds.
	 *	@param		float		$end			End timestamp, in microseconds.
	 *											If not specified, microtime() will be called.
	 *	@return		void
	 */
	protected function profileAction($action, $result, $start, $end = -1)
	{
		if ($end === -1) {
			$end = (float)microtime(TRUE);
		}
		$this->profile->addRecord($action, $result, $start, $end);
	}
	
	
	//  ============
	//  Misc Methods
	//  ************
	
	
	/**
	 * Serializes a object into a string
	 *
	 * @access	public
	 * @return	string		
	 */
	public function toString()
	{
		$objectvars = get_object_vars($this);
		foreach($objectvars as $key => $value) {
			$content .= $key . '=\'' . $value. '\'; ';
		}
		return 'Instance of ' . get_class($this) . '; Properties: ' . $content;
	}
}

?>