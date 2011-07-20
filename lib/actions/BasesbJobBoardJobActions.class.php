<?php

/**
 * Base sbJobBoardJob actions.
 *
 * @package    asandbox
 * @subpackage sbJobBoardJob
 * @author     Superrb Studio
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BasesbJobBoardJobActions extends aEngineActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
		$this->jobs = sbJobBoardJobTable::getJobs(null, true, null);
  }
	
	public function executeJob(sfWebRequest $request)
	{
		$this->job = sbJobBoardJobTable::getInstance()->findOneBySlug($request->getParameter('slug'));
		$this->forward404Unless($this->job instanceof sbJobBoardJob);
	}
}