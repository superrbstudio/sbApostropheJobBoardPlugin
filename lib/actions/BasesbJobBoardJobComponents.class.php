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
		if(!isset($this->numJobs) or !is_numeric($this->numJobs)){ $this->numJobs = 5; }
		$this->jobs = sbJobBoardJobTable::getJobs($this->numJobs, true, null);
	}

	public function executeHotJobs()
	{
		if(!isset($this->numJobs) or !is_numeric($this->numJobs)){ $this->numJobs = 5; }
		$this->jobs = sbJobBoardJobTable::getJobs($this->numJobs, true, true);
	}

	public function executeFormatSalary()
	{
		$this->currencySymbol = sbJobBoardJobTable::currencySymbol($this->job['salary_currency']);
	}

	public function executeBasicSearch()
	{
		$this->form = new sbJobBoardJobSearchForm();
		$this->form->bind($this->getRequest()->getParameter('search'));
	}

	public function executeSearch()
	{
		$this->form = new sbJobBoardJobSearchForm();
		$this->form->bind($this->getRequest()->getParameter('search'));
	}
}
