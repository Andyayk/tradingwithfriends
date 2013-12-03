<?php

$userArriveBySubmittingAForm = !empty($_POST);

if ($userArriveBySubmittingAForm) {

	$noid = empty($_POST['id']); //Empty post
	$idNotNumeric = !is_numeric($_POST['id']); //Post not numeric
	$idNotInRange = ($_POST['id']<0); //Post not in range
	
	if ($noid) {
		$errors['id'] = "Please enter the ID of the equity you wish to sell"; //If no id
	} elseif ($idNotNumeric) {
		$errors['id'] = "ID entered is not a number"; //If id not is a number
	} elseif ($idNotInRange) {
		$errors['id'] = "ID entered is not in range"; //If id not is in range
	}
	
	$noquantity = empty($_POST['sellQuantity']); //Empty post
	$quantityNotNumeric = !is_numeric($_POST['sellQuantity']); //Post not numeric
	$quantityNotInRange = ($_POST['sellQuantity']<0); //Post not in range

	if ($noquantity) {
		$errors['sellQuantity'] = "Please enter the quantity you wish to sell"; //If no quantity
	} elseif ($quantityNotNumeric) {
		$errors['sellQuantity'] = "Quantity entered is not a number"; //If quantity is not a number
	} elseif ($quantityNotInRange) {
		$errors['sellQuantity'] = "Quantity entered is not in range"; //If quantity is not in range
	}
	
	$noErrors = (count($errors) == 0);
	$haveErrors = !$noErrors;

	//No errors
	if ($noErrors) {
		if (!empty($_POST['sellQuantity'])) { //Get quantity
			$quantity = $_POST['sellQuantity'];
		}
		if (!empty($_POST['id'])) { //Get id
			$id = $_POST['id'];
		}

	}
}

?>