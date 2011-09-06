<?php

/**
 * PluginsbJobBoardJob
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginsbJobBoardJob extends BasesbJobBoardJob
{
	public function getSearchText()
	{
		return $this->getTitle() . implode(' ', $this->getTags());
	}

	public function getSummary()
	{
		return $this->getTitle();
	}

	public function postSave($event)
	{
		parent::postSave($event);

		aTools::$searchService->update(
			array(
				'item' => $this,
				'text' => $this->getSearchText(),
				'info' => array('summary' => $this->getSummary()),
				'culture' => aTools::getUserCulture()));
	}

	public function postDelete($event)
	{
		parent::postDelete($event);

		aTools::$searchService->delete(
			array(
				'item' => $this
			)
		);
	}

}
