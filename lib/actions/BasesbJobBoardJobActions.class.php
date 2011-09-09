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
  * @param sfWebRequest $request
  */
  public function executeIndex(sfWebRequest $request)
  {
		$params = array();

		// are there parameters
		if($request->getParameter('search') != '')
		{
			$params = $request->getParameter('search');
		}

		$this->jobs = sbJobBoardJobTable::getJobs(null, true, null, false, 'updated_at', 'DESC', $params);
  }

	public function executeJob(sfWebRequest $request)
	{
		$this->edit = $this->getUser()->isAuthenticated();
		$this->job = sbJobBoardJobTable::getInstance()->findOneBySlug($request->getParameter('slug'));
		$this->forward404Unless($this->job instanceof sbJobBoardJob);

		$prefix = aTools::getOptionI18n('title_prefix');
    $suffix = aTools::getOptionI18n('title_suffix');
    $this->getResponse()->setTitle($prefix . $this->job->getTitle() . $suffix, false);
		$this->getResponse()->addMeta('description', $this->job->getSummary());
	}
}
