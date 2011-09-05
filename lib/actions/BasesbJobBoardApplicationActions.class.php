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
			if($this->sendEmail())
			{
				$this->getUser()->setFlash('form_success', true);
			}
			else
			{
				$this->getUser()->setFlash('form_success', false);
			}
		}

		$this->redirect(url_for('/candidates#candidates-application-form'));
	}

	protected function sendEmail()
	{
		$content  = "Contact Name.......: " . $this->form->getValue('name') . "\n";
		$content .= "Contact Email......: " . $this->form->getValue('email') . "\n";
		$content .= "Contact Number.....: " . $this->form->getValue('phone_number') . "\n";
		$content .= "....................\n";
		$content .= "Sent at " . date('Y-m-d H:i:s');

		$message = Swift_Message::newInstance()
								->setFrom($this->form->getValue('email'))
								->setTo(sfConfig::get('app_a_sb_job_board_application_contact_email'))
								->setSubject('New CV from ' . $_SERVER['SERVER_NAME'])
								->setBody($content)
								->attach(Swift_Attachment::fromPath($this->form->getValue('cv_file')));

		try
		{
			$this->getMailer()->send($message);
		}
		catch (Exception $e)
		{
			return false;
		}

		return true;
	}
}
