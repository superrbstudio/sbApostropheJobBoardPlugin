<?php

/**
 * Base sbJobBoardJob actions.
 *
 * @package    asandbox
 * @subpackage sbJobBoardJob
 * @author     Superrb Studio
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BasesbJobBoardApplicationActions extends BaseaActions
{
	public function executeApplication(sfWebRequest $request)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
		$this->forward404Unless($request->isMethod('post'));

		$this->form = new sbJobBoardApplicationForm();
		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		$this->getUser()->setFlash('form', $this->form);

		if($this->form->isValid())
		{
			// save details and send email
			$this->form->save();

			if($this->sendEmail($request))
			{
				$this->getUser()->setFlash('email_success', true);
			}
			else
			{
				$this->getUser()->setFlash('email_success', false);
			}
		}

		$this->redirect(url_for('/candidates#candidates-application-form'));
	}

	protected function sendEmail(sfWebRequest $request)
	{
		$content  = "Contact Name.......: " . $this->form->getValue('name') . "\n";
		$content .= "Contact Email......: " . $this->form->getValue('email') . "\n";
		$content .= "Contact Number.....: " . $this->form->getValue('phone_number') . "\n";
		$content .= "CV File............: " . $request->getUriPrefix() . '/web/cvs/' . $this->form->getValue('cv_file') . "\n";
		$content .= "....................\n";
		$content .= "Sent at " . date('Y-m-d H:i:s');

		try
		{
			$this->getMailer()->composeAndSend($this->form->getValue('email'), sfConfig::get('app_a_sb_job_board_application_contact_email'), 'New CV from ' . $request->getHost(), $content);
		}
		catch (Exception $e)
		{
			return false;
		}

		return true;
	}
}
