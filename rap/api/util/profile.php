<?php

class Profile implements IteratorAggregate
{
	//! Profiling data
	private /*. ProfileRecord[int] .*/ $recordset = NULL;
	
	
	/**
	 *	\brief		Like mysqli->query(), but supports profiling.
	 *	@param		string		$action			Action name.
	 *	@param		bool		$result			Action result.
	 *	@param		float		$start			Start timestamp, in microseconds.
	 *	@param		float		$end			End timestamp, in microseconds.
	 *											If not specified, microtime() will be called.
	 *	@return		void
	 */
	public function addRecord($action, $result, $start, $end = -1)
	{
		if ($end === -1) {
			$end = (float)microtime(TRUE);
		}
		/*. ProfileRecord .*/ $record = new ProfileRecord($action, $result, $start, $end);
		$this->recordset[count($this->recordset)] = $record;
	}
	
	/**
	 *	\brief		Return a single record from the profile, or NULL.
	 *	@param		int			$id			Record number.
	 *	@return		ProfileRecord
	 */
	public function getRecord($id)
	{
		return @$this->recordset[$id];
	}
	
	/**
	 *	\brief		Return the number of records.
	 *	@return		int
	 */
	public function length()
	{
		return count($this->recordset);
	}
	
	/**
	 *	\brief		Allows foreach.
	 *	@return		ArrayIterator
	 */
	public function getIterator()
	{
		return new ArrayIterator($this->recordset);
	}
	
	/**
	 *	\brief		Prints recorded actions in a HTML table.
	 *	@return		ArrayIterator
	 */
	public function getHTMLTable()
	{
		/*. string .*/  $out  = '';
		/*. int .*/     $i    = 0;
		/*. int .*/     $max  = count($this->recordset);
		
		$out  = '<table border="1" cellspacing="0" cellpadding="5">' . "\n";
		$out .= "\t" . '<thead>' . "\n";
		$out .= "\t\t" . '<tr>' . "\n";
		$out .= "\t\t\t" . '<td>&nbsp;</td>' . "\n";
		$out .= "\t\t\t" . '<td><strong>Action</strong></td>' . "\n";
		$out .= "\t\t\t" . '<td><strong>Result</strong></td>' . "\n";
		$out .= "\t\t\t" . '<td><strong>Duration</strong></td>' . "\n";
		$out .= "\t\t" . '</tr>' . "\n";
		$out .= "\t" . '</thead>' . "\n";
		
		$out .= "\t" . '<tbody>' . "\n";
		
		for ( ; $i < $max; $i++) {
			$out .= "\t\t" . '<tr>' . "\n";
			$out .= "\t\t\t" . '<td>' . (string)$i . "\n";
			$out .= "\t\t\t" . '<td>' . htmlspecialchars($this->recordset[$i]->getAction()) . '</td>' . "\n";
			$out .= "\t\t\t" . '<td>' . htmlspecialchars($this->recordset[$i]->getResult()) . '&nbsp;</td>' . "\n";
			$out .= "\t\t\t" . '<td>' . sprintf('%f', $this->recordset[$i]->getDuration()) . '</td>' . "\n";
			$out .= "\t\t" . '</tr>' . "\n";
		}
		
		$out .= "\t" . '</tbody>' . "\n";
		$out .= '</table>' . "\n";
		
		return $out;
	}
}

?>