<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$edit = true;
?>
<hr/>
<h3 class="job-board-description">Job Description</h3>
<?php a_area('jobDescription', array(
	  'edit' => $edit, 'toolbar' => 'basic', 'slug' => aPageTable::getFirstEnginePage('sbJobBoardJob')->slug . "/" . $form->getObject()->getSlug(),
	  'allowed_types' => array('aRichText'),
	  'type_options' => array(
	    'aRichText' => array('tool' => 'Main'),
	))) ?>
<hr/>
