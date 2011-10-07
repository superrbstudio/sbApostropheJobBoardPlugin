<?php

abstract class BasesbJobBoardJobAjaxActions extends BaseaActions
{
	public function executeAjaxJobTitles(sfWebRequest $request)
	{
		$this->forward404Unless($this->getUser()->isAuthenticated());
		$this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');
		$keylessTitles = array();
		$titles = sbJobBoardJobTable::getTitles();
		foreach($titles as $title){$keylessTitles[] = $title;}
		$this->getResponse()->setContent(json_encode($keylessTitles));
		return sfView::NONE;
	}

	public function executeAjaxJobLocations(sfWebRequest $request)
	{
		$this->forward404Unless($this->getUser()->isAuthenticated());
		$this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');
		$keylessLocations = array();
		$locations = sbJobBoardJobTable::getLocations();
		foreach($locations as $location){$keylessLocations[] = $location;}
		$this->getResponse()->setContent(json_encode($keylessLocations));
		return sfView::NONE;
	}

	public function executeAjaxJobDurations(sfWebRequest $request)
	{
		$this->forward404Unless($this->getUser()->isAuthenticated());
		$this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');
		$keylessDurations = array();
		$durations = sbJobBoardJobTable::getDurations();
		foreach($durations as $duration){$keylessDurations[] = $duration;}
		$this->getResponse()->setContent(json_encode($keylessDurations));
		return sfView::NONE;
	}

	public function executeAjaxJobSalaryBenefits(sfWebRequest $request)
	{
		$this->forward404Unless($this->getUser()->isAuthenticated());
		$this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');
		$keylessSalaryBenefits = array();
		$benefits = sbJobBoardJobTable::getSalaryBenefits();
		foreach($benefits as $benefit){$keylessSalaryBenefits[] = $benefit;}
		$this->getResponse()->setContent(json_encode($keylessSalaryBenefits));
		return sfView::NONE;
	}
}
