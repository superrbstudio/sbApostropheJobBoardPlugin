<h3>Hot Jobs</h3>
<ul>
<?php foreach($jobs as $job): ?>
	<li>
		<span class="title"><?php echo $job['title']; ?></span> 
		<span class="location"><?php echo $job['location']; ?></span> 
		<span class="salary"><?php include_component('sbJobBoardJob', 'FormatSalary', array('job' => $job)); ?></span>
	</li>
<?php endforeach; ?>
</ul>
