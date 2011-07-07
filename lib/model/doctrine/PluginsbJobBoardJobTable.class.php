<?php

/**
 * PluginsbJobBoardJobTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginsbJobBoardJobTable extends Doctrine_Table
{
	/**
	 * Returns an instance of this class.
	 *
	 * @return object PluginsbJobBoardJobTable
	 */
	public static function getInstance()
	{
			return Doctrine_Core::getTable('PluginsbJobBoardJob');
	}
		
	public function addCategoriesForUser(sfGuardUser $user, $admin = false)
  {
    $q = $this->addCategories();  
    return Doctrine::getTable('aCategory')->addCategoriesForUser($user, $admin, $q);
  }
	
	public function addCategories(Doctrine_Query $q=null)
  {
    if(is_null($q))
      $q = Doctrine::getTable('aCategory')->createQuery();
      
    $q->addOrderBy('aCategory.name');
    return $q;
  }
}