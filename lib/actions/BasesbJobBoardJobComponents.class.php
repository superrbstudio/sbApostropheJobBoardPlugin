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

		// crazy hack because defaults aren't working for some reason?
		if($this->getRequest()->getParameter('search') == '')
		{
			$param = array('keywords' => '',
										 'location' => 'any',
										 'sector' => 'any',
										 'job_type' => 'any',
										 'times' => date('Y-m-d', strtotime('-14 days')));
		}
		else
		{
			$param = $this->getRequest()->getParameter('search');
		}

		$this->form->bind($param);
	}

	public function executeRelatedJobs()
	{
		$tags = array();

		foreach($this->job->getTags() as $tag)
		{
			$tags[] = $tag;
		}

		$jobs = PluginTagTable::getObjectTaggedWith(implode(',', $tags), array('nb_common_tags' => 1, 'model' => 'sbJobBoardJob'));

		if(!isset($this->limit) or !is_numeric($this->limit))
		{
			$this->limit = 4;
		}

		$i = 1;
		$this->jobs = array();

		foreach($jobs as $job)
		{
			$this->jobs[] = $job;
			$i++;
			if($i > $this->limit) { break; }
		}
	}
}
