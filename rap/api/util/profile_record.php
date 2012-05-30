<?php

/**
 *	\class		ProfileRecord
 *	\brief		Info about a single action performed.
 */
class ProfileRecord
{
	//! Action performed.
	private /*. string .*/  $action    = '';
	//! Action's result. May be a boolean indicating success, or an integer status value, for example.
	private /*. mixed .*/   $success   = FALSE;
	//! Timestamp when the action started, in seconds.
	private /*. float .*/   $start     = 0;
	//! Duration of the action, in seconds.
	private /*. float .*/   $duration  = 0;
	
	
	/**
	 *	\brief		Return action name.
	 *	@return		string
	 */
	function getAction()
	{
		return $this->action;
	}
	
	/**
	 *	\brief		Return if the action succeded.
	 *	@return		mixed
	 */
	function getResult()
	{
		return $this->success;
	}
	
	/**
	 *	\brief		Return start timestamp.
	 *	@return		float
	 */
	function getStart()
	{
		return $this->start;
	}
	
	/**
	 *	\brief		Return action's duration.
	 *	@return		float
	 */
	function getDuration()
	{
		return $this->duration;
	}
	
	/**
	 *	\brief		Constructor.
	 *	@param		string		$action			Name of the action performed.
	 *	@param		bool		$success		Did the action succeded?
	 *	@param		mixed		$start			Timestamp when the action started, in seconds.
	 *	@param		mixed		$end			Timestamp when the action ended, in seconds.
	 *	@return		void
	 */
	function __construct($action, $success, $start, $end)
	{
		$this->action    = $action;
		$this->success   = $success;
		$this->start     = (float)$start;
		$this->duration  = (float)$end - (float)$start;
	}
}

?>