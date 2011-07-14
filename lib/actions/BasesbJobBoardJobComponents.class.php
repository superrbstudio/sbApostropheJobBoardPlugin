<?php

/**
 * Base Components for the sbJobBoardPlugin module.
 * 
 * @package     sbJobBoardPlugin
 * @subpackage  sbJobBoardJob
 * @author      Superrb Studio
 */
abstract class BasesbJobBoardJobComponents extends sfComponents
{
	public function executeLatestVacancies() 
	{
		$this->jobs = sbJobBoardJobTable::getJobs(5);
	}
}