<?php // Breadcrumb is removed for the home page template because it is redundant ?>
<?php slot('a-breadcrumb', '') ?>

<?php // Subnav is removed for the home page template because it is redundant ?>
<?php slot('a-subnav', '') ?>

<section>
	<h1 class="page-title">Job Vacancies</h1>
	
	<ul class="vacancies-list">
		<?php foreach($jobs as $job): ?>
		<li>
			<a class="job-title" href="<?php echo url_for('@sb_job_board_job_page?slug=' . $job['slug']); ?>">
				<span><?php echo $job['title']; ?></span>
			</a>
			<dl>
				<dt>Location:</dt>
				<dd><?php echo $job['location']; ?></dd>
				<dt>Industry:</dt>
				<dd><?php foreach($job['Categories'] as $category) { echo $category['name']; } ?></dd>
				<dt>Salary:</dt>
				<dd><?php include_component('sbJobBoardJob', 'FormatSalary', array('job' => $job)); ?></dd>
			</dl>
			<a class="read-more" href="<?php echo url_for('@sb_job_board_job_page?slug=' . $job['slug']); ?>">Read More</a></span>
		</li>
		<?php endforeach; ?>
	</ul>
	
</section>