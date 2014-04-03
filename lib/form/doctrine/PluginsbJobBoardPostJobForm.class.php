<?php

/**
 * PluginsbJobBoardPostJob form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginsbJobBoardPostJobForm extends BasesbJobBoardJobForm
{
    public function setup()
    {
        parent::setup();
        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

        $years = range(date('Y'), date('Y') + 5);

        $this->setWidget('title', new sbApostropheJQueryInputAutocomplete(array('source' => url_for('@sb_job_board_autocomplete_titles')), array('class' => 'large-input')));
        $this->setValidator('title', new sfValidatorString(array('required' => true), array()));

        $this->setWidget('duration', new sbApostropheJQueryInputAutocomplete(array('source' => url_for('@sb_job_board_autocomplete_durations')), array('class' => 'large-input')));

        $this->setWidget('location', new sbApostropheJQueryInputAutocomplete(array('source' => url_for('@sb_job_board_autocomplete_locations')), array('class' => 'large-input')));
        $this->setValidator('location', new sfValidatorString(array('required' => true), array()));

        $this->setWidget('startdate', new sfWidgetFormDate(array('label' => 'Start date', 'can_be_empty' => false, 'years' => array_combine($years, $years), 'format' => '%day%%month%%year%', 'default' => 'today')));
        $this->setValidator('startdate', new sfValidatorDate(array('required' => true)));

        $this->setWidget('salary_benefits', new sbApostropheJQueryInputAutocomplete(array('source' => url_for('@sb_job_board_autocomplete_salary_benefits')), array('class' => 'large-input')));

        // Tags
        $options['default'] = implode(', ', $this->getObject()->getTags());
        if (sfConfig::get('app_a_all_tags', true))
        {
            $options['all-tags'] = PluginTagTable::getAllTagNameWithCount();
        }
        else
        {
            $options['typeahead-url'] = url_for('taggableComplete/complete');
        }

        $options['popular-tags'] = PluginTagTable::getPopulars(null, array(), false);
        $this->setWidget('tags', new pkWidgetFormJQueryTaggable($options, array('class' => 'tags-input')));
        $this->setValidator('tags', new sfValidatorString(array('required' => false)));

        $q = Doctrine::getTable($this->getModelName())->addCategories();
        $this->setWidget('categories_list', new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => $this->getModelName(), 'query' => $q)));
        $this->setValidator('categories_list', new sfValidatorDoctrineChoice(array('multiple' => true, 'model' =>  $this->getModelName(), 'query' => $q, 'required' => false)));

        unset($this['created_at'], $this['updated_at'], $this['author']);

        $this->disableCSRFProtection();
    }
}
