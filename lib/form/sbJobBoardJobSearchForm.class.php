<?php

class sbJobBoardJobSearchForm extends sfForm
{
	public function configure()
	{
		$locations = array_merge(array('any' => 'All Locations'), sbJobBoardJobTable::getLocations());
		$sectors   = array_merge(array('any' => 'All sectors'), sbJobBoardJobTable::getSectors());
		$types     = array_merge(array('any' => 'All types'), sbJobBoardJobTable::getJobTypes());
		$times     = array('any' => 'All', date('Y-m-d', strtotime('-2 weeks')) => '14 days ago', date('Y-m-d', strtotime('-1 week')) => '7 days ago', date('Y-m-d', strtotime('yesterday')) => 'Yesterday', date('Y-m-d', strtotime("today")) => 'Today');

		$this->setWidgets(array(
			'keywords' => new sfWidgetFormInputText(array(), array('title' => 'Enter keywords to find a related job', 'class' => 'search_keywords')),
			'location' => new sfWidgetFormChoice(array('choices' => $locations),  array('title' => 'Choose a location', 'class' => 'search_location')),
			'sectors'  => new sfWidgetFormChoice(array('choices' => $sectors),  array('title' => 'Choose a sector', 'class' => 'search_sector')),
			'job_type' => new sfWidgetFormChoice(array('choices' => $types, 'expanded' => true), array('title' => 'Choose a contract type', 'class' => 'search_job_type')),
			'times'    => new sfWidgetFormChoice(array('choices' => $times, 'expanded' => true), array('title' => 'Choose a date filter', 'class' => 'search_times')),
		));

		$this->widgetSchema->setNameFormat('search[%s]');
	}
}
