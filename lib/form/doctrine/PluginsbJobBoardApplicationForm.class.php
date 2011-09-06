<?php

/**
 * PluginsbJobBoardApplication form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginsbJobBoardApplicationForm extends BasesbJobBoardApplicationForm
{
	public function configure()
	{
		$this->setWidgets(array(
			'name' => new sfWidgetFormInputText(array('default' => 'Name'), array('title' => 'Please enter your name', 'class' => 'application_name')),
			'email' => new sfWidgetFormInputText(array('default' => 'Email address'),  array('title' => 'Please enter your email address', 'class' => 'application_email')),
			'phone_number' => new sfWidgetFormInputText(array('default' => 'Phone number'),  array('title' => 'Please enter your phone number', 'class' => 'application_phone_number')),
			'job_type' => new sfWidgetFormInputText(array('default' => 'Job type'),  array('title' => 'Please describe what jobs interest you', 'class' => 'application_job_type')),
			'cv_file' => new sfWidgetFormInputFile(array('label' => 'Upload CV'))
		));

		$this->widgetSchema->setNameFormat('application[%s]');

		$this->setValidators(array(
			'name' => new sfValidatorString(),
			'email' => new sfValidatorEmail(),
			'phone_number' => new sfValidatorString(),
			'job_type' => new sfValidatorString(),
			'cv_file' => new sfValidatorFile(array('path' => sfConfig::get('sf_upload_dir') . '/cvs',
																						 'max_size' => 5000000,
																						 'mime_types' => array('application/msword',
																																	 'application/vnd.ms-office',
																																	 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
																																	 'application/doc',
																																	 'appl/text',
																																	 'application/vnd.msword',
																																	 'application/vnd.ms-word',
																																	 'application/winword',
																																	 'application/word',
																																	 'application/x-msw6',
																																	 'application/x-msword',
																																	 'application/rtf',
																																	 'application/x-rtf',
																																	 'text/richtext',
																																	 'application/rtf',
																																	 'text/richtext',
																																	 'application/pdf')))
		));

		unset($this['updated_at'], $this['created_at']);
	}
}
