<?php

/**
 * Base Components for the sbJobBoardPlugin module.
 *
 * @package     sbJobBoardPlugin
 * @subpackage  sbJobBoardJob
 * @author      Superrb Studio
 */
abstract class BasesbJobBoardApplicationComponents extends sfComponents
{
	public function executeApplicationForm()
	{
		$this->edit              = false;
		$this->showThanks        = false;
		$this->displayEmailError = false;

		// is the user authenticated and able to edit the form content
		if($this->getUser()->isAuthenticated())
		{
			$this->edit = true;
		}

		// is there a form in the flash
		if($this->getUser()->getFlash('form') != '' and $this->getUser()->getFlash('form') instanceof sbJobBoardApplicationForm)
		{
			$this->form = $this->getUser()->getFlash('form');
		}
		else
		{
			$application = null;

			if($this->getRequest()->getParameter('applicationId') != '')
			{
				$application = new sbJobBoardApplication();
				$application->setJobType($this->getRequest()->getParameter('applicationId'));
			}

			$this->form = new sbJobBoardApplicationForm($application);
		}

		// Should we display the form success
		if(!is_null($this->getUser()->getFlash('email_success')))
		{
			if($this->getUser()->getFlash('email_success') == true)
			{
				$this->showThanks = true;
			}
			elseif($this->getUser()->getFlash('email_success') == false)
			{
				$this->displayEmailError = true;
			}
		}
	}
}
