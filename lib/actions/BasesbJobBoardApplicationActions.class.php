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

		$this->redirect(url_for($request->getParameter('redirect_page')));
	}

	protected function sendEmail(sfWebRequest $request)
	{

		// are we using S3?
		$uriPrefix = sfConfig::get('app_a_static_url');

		if($uriPrefix == '')
		{
			$uriPrefix = $request->getUriPrefix();
		}

		$info = sfConfig::get('app_a_sb_job_board_application');
		$file = explode('/', $this->form->getValue('cv_file'));
    $subject  = 'New CV from ' . $request->getHost();
		$content  = "Contact Name.......: " . $this->form->getValue('name') . "\r\n";
		$content .= "Contact Email......: " . $this->form->getValue('email') . "\r\n";
		$content .= "Contact Number.....: " . $this->form->getValue('phone_number') . "\r\n";
		$content .= "CV File............: " . $uriPrefix . '/uploads/cvs/' . $file[count($file) - 1] . "\r\n";
		$content .= "Message............:\r\n " . $this->form->getValue('job_type') . "\r\n";
		$content .= "....................\r\n";
		$content .= "Sent at " . date('Y-m-d H:i:s');
    
    try
		{
      $message = $this->getMailer()->compose();
      $message->setSubject($subject);
      $message->setTo($info['contact_email_to']);
      $message->setBcc($info['contact_email_bcc']);
      $message->setFrom($info['contact_email_from']);
      $message->setReplyTo(array($this->form->getValue('email') => $this->form->getValue('name')));
      $message->setBody($content);
      
      $this->getMailer()->send($message);
		}
		catch (Exception $e)
		{
			return false;
		}

		return true;
	}
}
