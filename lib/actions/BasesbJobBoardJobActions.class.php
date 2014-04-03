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
        $this->forward404Unless($this->job->getActive());

		$prefix = aTools::getOptionI18n('title_prefix');
        $suffix = aTools::getOptionI18n('title_suffix');
        $this->getResponse()->setTitle($prefix . $this->job->getTitle() . $suffix, false);
		$this->getResponse()->addMeta('description', $this->job->getSummary());
	}

    public function executePost(sfWebRequest $request)
    {
        $apiId  = $request->getParameter('api_id');
        $apiKey = $request->getParameter('api_key');
        $keys   = sfConfig::get('app_a_sb_job_board');

        $this->getResponse()->setHttpHeader('Content-type','application/json');

        if($apiId and $apiKey and $apiId == $keys['api_id'] and $apiKey == $keys['api_key'])
        {
            $details = array(
                'featured' => $request->getParameter('featured'),
                'reference' => $request->getParameter('reference'),
                'title' => $request->getParameter('title'),
                'type' => $request->getParameter('type'),
                'duration' => $request->getParameter('duration'),
                'startdate' => $request->getParameter('startdate'),
                'location' => $request->getParameter('location'),
                'salary_currency' => $request->getParameter('salary_currency'),
                'salary_from' => $request->getParameter('salary_from'),
                'salary_to' => $request->getParameter('salary_to'),
                'salary_per' => $request->getParameter('salary_per'),
                'salary_benefits' => $request->getParameter('salary_benefits'),
                'tags' => $request->getParameter('tags'),
                'categories_list' => $request->getParameter('categories'),
            );

            // work out tags


            $form = new sbJobBoardPostJobForm();
            $form->bind($details);

            if($form->isValid())
            {
                $job = new sbJobBoardJob();
                $job->setFeatured($details['featured']);
                $job->setReference($details['reference']);
                $job->setTitle($details['title']);
                $job->setType($details['type']);
                $job->setDuration($details['duration']);
                $job->setStartdate($details['startdate']);
                $job->setlocation($details['location']);
                $job->setSalaryCurrency($details['salary_currency']);
                $job->setSalaryFrom($details['salary_from']);
                $job->setSalaryTo($details['salary_to']);
                $job->setSalaryBenefits($details['salary_benefits']);
                $job->save();

                echo json_encode(array('success' => true));
            }
            else
            {
                $errors = array();

                foreach($form->getGlobalErrors() as $error)
                {
                    $errors[] = $error->__toString();
                }

                foreach($form as $key => $field)
                {
                    if($field->hasError())
                    {
                        $errors[] = $key  . ' ' . $field->getError()->__toString();
                    }
                }

                echo json_encode(array('success' => false, 'errors' => $errors));
            }
        }
        else
        {
            echo json_encode(array('success' => false, 'errors' => array('Invalid API Credentials Given')));
        }

        $this->setLayout(false);
        return sfView::NONE;
    }
}
