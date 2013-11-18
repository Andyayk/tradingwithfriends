<?php

$userArriveBySubmittingAForm = !empty($_POST);

$userArriveByClickingOrDirectlyTypeURL = !$userArriveBySubmittingAForm;

if ($userArriveBySubmittingAForm) {

	$noUserID = empty($_POST['id']);
	if ($noUserID) {
		$errors['id'] = "Please enter user id";
	}

	$noPassword = empty($_POST['pwd']);
	if ($noPassword) {
		$errors['pwd'] = "Please enter password";
	}
	
	$neverRetypePassword = empty($_POST['repwd']);
	if ($neverRetypePassword) {
		$errors['repwd'] = "Please retype password";
	} else {
		$passwordNotMatch = ($_POST['pwd'] != $_POST['repwd']);
		if ($passwordNotMatch) {
			$errors['pwd'] = "Please enter the same password";
			$errors['repwd'] = "Please enter the same password";
		}
	}
	
	$noName = empty($_POST['name']);
	if ($noName) {
		$errors['name'] = "Please enter a name";
	}
	
	$addressNotGiven = empty($_POST['address']);		
	if ($addressNotGiven) {			
		$errors['address'] = "Please enter an address";		
	} 

	$genderNotSelected = empty($_POST['gender']);
	if ($genderNotSelected) {
		$errors['gender'] = "Please select a gender";
	}

	$dayNotSelected = empty($_POST['day']);
	if ($dayNotSelected) {
		$errors['day'] = "Please select the day of birth";
	}	
	
	$monthNotSelected = empty($_POST['month']);
	if ($monthNotSelected) {
		$errors['month'] = "Please select the month of birth";
	}	
	
	$noYear = empty($_POST['year']);
	$yearNotNumeric = !is_numeric($_POST['year']);
	$yearNotInRange = ($_POST['year'] < (date('Y')-140) || $_POST['year'] > date('Y')); 
	$yearNotFourDigit = (strlen($_POST['year']) < 4 || strlen($_POST['year']) > 4);
	if ($noYear) {
		$errors['year'] = "Please enter the year of birth";
	} else if ($yearNotNumeric) {
			$errors['year'] = "Year of birth is not a number";
	} else if ($yearNotFourDigit) {
			$errors['year'] = "Year of birth should have four number digits";
	} else if ($yearNotInRange) {
			$errors['year'] = "Year of birth is not logical";
	}
	
	$interestNotSelected = empty($_POST['interest']);
	if ($interestNotSelected) {
		$errors['interest'] = "Please select at least one area of interest";
	}

	require_once('checkuserid.php');
	
	$noErrors = (count($errors) == 0);
	
	$haveErrors = !$noErrors;

	if ($noErrors) {

		if (!empty($_POST['id'])) {
			$userid = $_POST['id'];
		}
		if (!empty($_POST['pwd'])) {
			$password = $_POST['pwd'];
		}
		if (!empty($_POST['repwd'])) {
			$password2 = $_POST['repwd'];
		}
		if (!empty($_POST['name'])) {
			$name = $_POST['name'];
		}
		if (!empty($_POST['address'])) {
			$address = $_POST['address'];
		}
		if (!empty($_POST['gender'])) {
			$gender = $_POST['gender'];
		}
		if (!empty($_POST['day'])) {
			$day = $_POST['day'];
		}
		if (!empty($_POST['month'])) {
			$month = $_POST['month'];
		}
		if (!empty($_POST['year'])) {
			$year = $_POST['year'];
		}
		if (!empty($_POST['interest']) && is_array($_POST['interest'])) {
			$interest = $_POST['interest'];
		}

	}

}

?>