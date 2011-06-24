<?php

/**
 * PluginsbJobBoardJob form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginsbJobBoardJobForm extends BasesbJobBoardJobForm
{
	public function setup() 
	{
    parent::setup();
		
		$this->setWidget('author_id', new sfWidgetFormInputHidden(array(), array('value' => sfContext::getInstance()->getUser()->getGuardUser()->getId())));
		
		// Tags 
		$options['default'] = implode(', ', $this->getObject()->getTags()); 
		if (sfConfig::get('app_a_all_tags', true)) 
		{ 
			$options['all-tags'] = PluginTagTable::getAllTagNameWithCount(); 
		} 

		else 
		{ 
			sfContext::getInstance()->getConfiguration()->loadHelpers('Url'); 
			$options['typeahead-url'] = url_for('taggableComplete/complete'); 
		} 

		$options['popular-tags'] = PluginTagTable::getPopulars(null, array(), false); 
		$this->setWidget('tags', new pkWidgetFormJQueryTaggable($options, array('class' => 'tags-input'))); 
		$this->setValidator('tags', new sfValidatorString(array('required' => false))); 
		unset($this['created_at'], $this['updated_at']);
	}
}
