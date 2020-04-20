<?php include_once $_SERVER['DOCUMENT_ROOT'] .
		'/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Manage Entries: Search Results</title>
		<meta http-equiv="content-type"
				content="text/html; charset=utf-8"/>
		<style type="text/css">
.style1 {
	border-width: 0px;
}
.style2 {
	border-style: solid;
	border-width: 1px;
}
</style>
	</head>
	<body>
		<h1>Search Results</h1>
		<?php if (isset($jobs)): ?>
			<table class="style1">
				<tr><th class="style2">Guestbook Entries</th><th class="style2">Options</th></tr>
				<?php foreach ($jobs as $job): ?>
				<tr valign="top">
					<td class="style2"><?php htmlout ($job['text']); ?></td>
					<td class="style2">
						<form action="?" method="post">
							<div>
								<input type="hidden" name="id" value="<?php
										htmlout($job['id']); ?>"/>
								&nbsp;<input type="submit" name="action" value="Delete"/>
							</div>
						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
		<p><a href="?">New search</a></p>
		</body>
</html>
