<h3>Latest Vacancies</h3>
<ul>
<?php foreach($jobs as $job): ?>
	<li>
		<span class="title"><?php echo $job['title']; ?></span> 
		<span class="location"><?php echo $job['location']; ?></span> 
		<span class="salary">&pound;<?php echo number_format($job['salary_from'], 2); ?> to &pound;<?php echo number_format($job['salary_to'], 2); ?> per <?php echo $job['salary_per']; ?></span>
	</li>
<?php endforeach; ?>
</ul>
