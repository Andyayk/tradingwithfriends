<?php

	$userArriveBySubmittingAForm = !empty($_POST);

	if ($userArriveBySubmittingAForm) {

		$noid = empty($_POST['id']); //Empty post
		$idNotNumeric = !is_numeric($_POST['id']); //Post not numeric
		$idIsNegative = ($_POST['id']<0); //Post is negative
	
		//Error messages
		if ($noid) {
			$errors['id'] = "Please enter the ID of the equity you wish to sell"; 
		} elseif ($idNotNumeric) {
			$errors['id'] = "ID entered is not a number"; 
		} elseif ($idIsNegative) {
			$errors['id'] = "ID entered should not be negative";
		}
	
		$noquantity = empty($_POST['sellQuantity']); //Empty post
		$quantityNotNumeric = !is_numeric($_POST['sellQuantity']); //Post not numeric
		$quantityIsNegative = ($_POST['sellQuantity']<0); //Post is negative

		//Error messages
		if ($noquantity) {
			$errors['sellQuantity'] = "Please enter the quantity you wish to sell"; 
		} elseif ($quantityNotNumeric) {
			$errors['sellQuantity'] = "Quantity entered is not a number";
		} elseif ($quantityIsNegative) {
			$errors['sellQuantity'] = "Quantity entered should not be negative"; 
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