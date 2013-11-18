<?php

$userArriveBySubmittingAForm = !empty($_POST);

$userArriveByClickingOrDirectlyTypeURL = !$userArriveBySubmittingAForm;

if ($userArriveBySubmittingAForm) {

	$nameNotSelected = empty($_POST['name']);
	if ($nameNotSelected) {
		$errors['name'] = "Please select an Equity";
	}	
	
	$noQuantity = empty($_POST['quantity']);
	$quantityNotNumeric = !is_numeric($_POST['quantity']);
	$quantityNotInRange = ($_POST['quantity'] < 0 || $_POST['quantity'] > 100); 

	if ($noquantity) {
		$errors['quantity'] = "Please enter the Quantity you wish to purchase";
	} else if ($quantityNotNumeric) {
			$errors['quantity'] = "Quantity entered is not a number";
	} else if ($quantityNotInRange) {
			$errors['quantity'] = "Quantity entered is not logical";
	}
	
	$noErrors = (count($errors) == 0);
	$haveErrors = !$noErrors;

	if ($noErrors) {
		if (!empty($_POST['name'])) {
			$name = $_POST['name'];
		}
		if (!empty($_POST['quantity'])) {
			$quantity = $_POST['quantity'];
		}
	}
}

?>