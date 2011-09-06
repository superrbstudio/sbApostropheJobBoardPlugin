<?php

class sbJobBoardJobSearchForm extends sfForm
{
	public function configure()
	{
		$locations = array_merge(array('any' => 'All Locations'), sbJobBoardJobTable::getLocations());
		$sectors   = array_merge(array('any' => 'All sectors'), sbJobBoardJobTable::getSectors());

		$this->setWidgets(array(
			'keywords' => new sfWidgetFormInputText(array(), array('title' => 'Enter keywords to find a related job', 'class' => 'search_keywords')),
			'location' => new sfWidgetFormSelect(array('choices' => $locations),  array('title' => 'Choose a location', 'class' => 'search_location')),
			'sectors' => new sfWidgetFormSelect(array('choices' => $sectors),  array('title' => 'Choose a sector', 'class' => 'search_sector')),
		));

		$this->widgetSchema->setNameFormat('search[%s]');
	}
}
