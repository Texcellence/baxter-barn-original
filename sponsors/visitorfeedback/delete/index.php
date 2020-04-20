<?php

include_once $_SERVER['DOCUMENT_ROOT'] .

		'/includes/magicquotes.inc.php';

session_start();

if (isset($_GET['add']))

{

	$pagetitle = 'New Job';

	$action = 'addform';

	$text = '';

	$authorid = '';

	$id = '';

	$button = 'Add job';



	include $_SERVER['DOCUMENT_ROOT'] . '/jobs/includes/db.inc.php';



	// Build the list of authors

	$sql = "SELECT id, name FROM author";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching list of authors.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$authors[] = array('id' => $row['id'], 'name' => $row['name']);

	}



	// Build the list of categories

	$sql = "SELECT id, name FROM category";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching list of categories.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$categories[] = array(

				'id' => $row['id'],

				'name' => $row['name'],

				'selected' => FALSE);

	}



	include 'form.html.php';

	exit();

}



if (isset($_GET['addform']))

{

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';



	$text = mysqli_real_escape_string($link, $_POST['text']);

	$author = mysqli_real_escape_string($link, $_POST['author']);



	if ($author == '')

	{

		$error = 'You must choose an author for this job.

				Click &lsquo;back&rsquo; and try again.';

		include 'error.html.php';

		exit();

	}



	$sql = "INSERT INTO job SET

			jobtext='$text',

			jobdate=CURDATE(),

			authorid='$author'";

	if (!mysqli_query($link, $sql))

	{

		$error = 'Error adding submitted job.';

		include 'error.html.php';

		exit();

	}



	$jobid = mysqli_insert_id($link);



	if (isset($_POST['categories']))

	{

		foreach ($_POST['categories'] as $category)

		{

			$categoryid = mysqli_real_escape_string($link, $category);

			$sql = "INSERT INTO jobcategory SET

					jobid='$jobid',

					categoryid='$categoryid'";

			if (!mysqli_query($link, $sql))

			{

				$error = 'Error inserting job into selected category.';

				include 'error.html.php';

				exit();

			}

		}

	}



	header('Location: .');

	exit();

}



if (isset($_POST['action']) and $_POST['action'] == 'Edit')

{

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';



	$id = mysqli_real_escape_string($link, $_POST['id']);

	$sql = "SELECT id, jobtext, authorid FROM job WHERE id='$id'";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching job details.';

		include 'error.html.php';

		exit();

	}

	$row = mysqli_fetch_array($result);



	$pagetitle = 'Edit Job';

	$action = 'editform';

	$text = $row['jobtext'];

	$wage = $row['wage'];

	$location = $row['location'];

	$authorid = $row['authorid'];

	$id = $row['id'];

	$button = 'Update job';



	// Build the list of authors

	$sql = "SELECT id, name FROM author";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching list of authors.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$authors[] = array('id' => $row['id'], 'name' => $row['name']);

	}



	// Get list of categories containing this job	$sql = "SELECT categoryid FROM job category WHERE jobid='$id'";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching list of selected categories.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$selectedCategories[] = $row['categoryid'];

	}



	// Build the list of all categories

	$sql = "SELECT id, name FROM category";

	$result = mysqli_query($link, $sql);

	if (!$result)

	{

		$error = 'Error fetching list of categories.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$categories[] = array(

				'id' => $row['id'],

				'name' => $row['name'],

				'selected' => in_array($row['id'], $selectedCategories));

	}



	include 'form.html.php';

	exit();

}



if (isset($_GET['editform']))

{

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';



	$text = mysqli_real_escape_string($link, $_POST['text']);

	$author = mysqli_real_escape_string($link, $_POST['author']);

	$location = mysqli_real_escape_string($link, $_POST['location']);

	$wage = mysqli_real_escape_string($link, $_POST['wage']);

	$id = mysqli_real_escape_string($link, $_POST['id']);



	if ($author == '')

	{

		$error = 'You must choose an author for this job.

				Click &lsquo;back&rsquo; and try again.';

		include 'error.html.php';

		exit();

	}



	$sql = "UPDATE job SET

			jobtext='$text',

			location='$location',

			wage='$wage',

			authorid='$author'

			WHERE id='$id'";

	if (!mysqli_query($link, $sql))

	{

		$error = 'Error updating submitted job.';

		include 'error.html.php';

		exit();

	}



	$sql = "DELETE FROM jobcategory WHERE jobid='$id'";

	if (!mysqli_query($link, $sql))

	{

		$error = 'Error removing obsolete job category entries.';

		include 'error.html.php';

		exit();

	}



	if (isset($_POST['categories']))

	{

		foreach ($_POST['categories'] as $category)

		{

			$categoryid = mysqli_real_escape_string($link, $category);

			$sql = "INSERT INTO jobcategory SET

					jobid='$id',

					categoryid='$categoryid'";

			if (!mysqli_query($link, $sql))

			{

				$error = 'Error inserting job into selected category.';

				include 'error.html.php';

				exit();

			}

		}

	}



	header('Location: .');

	exit();

}



if (isset($_POST['action']) and $_POST['action'] == 'Delete')

{

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	$id = mysqli_real_escape_string($link, $_POST['id']);



	$sql = "DELETE FROM guestbook WHERE id='$id'";

	if (!mysqli_query($link, $sql))

	{

		$error = 'Error deleting job.';

		include 'error.html.php';

		exit();

	}



	header('Location: .');

	exit();

}



if (isset($_GET['action']) and $_GET['action'] == 'search')

{

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';



	// The basic SELECT statement

	$select = 'SELECT id, comment, name';

	$from   = ' FROM guestbook';

	$where  = ' WHERE TRUE';



	$result = mysqli_query($link, $select . $from . $where);

	if (!$result)

	{

		$error = 'Error fetching jobs.';

		include 'error.html.php';

		exit();

	}



	while ($row = mysqli_fetch_array($result))

	{

		$jobs[] = array('id' => $row['id'], 'text' => $row['comment'], 'name' => $row['name']);

	}



	include 'jobs.html.php';

	exit();

}



// Display search form

include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

include 'searchform.html.php';

?>