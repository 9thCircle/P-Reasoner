<?php

interface iProfiling
{
	/**
	 *	\brief		Returns TRUE, meaning that profiling is supported.
	 *	@return		bool
	 */
	function supportsProfiling();
	
	/**
	 *	\brief		Activate profiling.
	 *	@return		void
	 */
	public function startProfile();
	
	/**
	 *	\brief		Deactivate profiling.
	 *	@return		void
	 */
	public function stopProfile();
	
	/**
	 *	\brief		Returns wether profiling is active.
	 *	@return		bool
	 */
	public function isProfiling();
	
	/**
	 *	\brief		Returns profiling information.
	 *	@return		Profile
	 */
	public function getProfile();
}

?>