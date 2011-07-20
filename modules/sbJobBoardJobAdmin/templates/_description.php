<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$sbJobBoardJob = $form->getObject();
$edit = true;
?>
<?php var_dump($sbJobBoardJob->getSlug()); ?>
<?php a_area('jobDescription', array(
	  'edit' => $edit, 'toolbar' => 'basic', 'slug' => url_for('@sb_job_board_job_page?slug=' . $sbJobBoardJob->getSlug()),
	  'allowed_types' => array('aRichText'),
	  'type_options' => array(
	    'aRichText' => array('tool' => 'Main'),
	))) ?>