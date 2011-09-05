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
			$this->form = new sbJobBoardApplicationForm();
		}

		// Should we display the form success
		if($this->getUser()->getFlash('email_success') == true)
		{
			$this->showThanks = true;
		}
		else
		{
			$this->displayEmailError = true;
		}
	}
}
