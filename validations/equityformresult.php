<?php

$userArriveBySubmittingAForm = !empty($_POST);

$userArriveByClickingOrDirectlyTypeURL = !$userArriveBySubmittingAForm;

if ($userArriveBySubmittingAForm) {

	$nameNotSelected = empty($_POST['name']);
	if ($nameNotSelected) {
		$errors['name'] = "Please select an equity";
	}
	
	$noquantity = empty($_POST['quantity']);
	$quantityNotNumeric = !is_numeric($_POST['quantity']);
	$quantityNotInRange = ($_POST['quantity'] < 0 || $_POST['quantity'] > 100); 

	if ($noquantity) {
		$errors['quantity'] = "Please enter the quantity you wish to purchase";
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

	    require 'scripts/equity_price.php';
	  	if ($_POST['name']=="AAPL"){
	  	$price = $aapl;
	  	}
	  	elseif ($_POST['name']=="FB"){
	  	$price = $fb;
	  	}
	  	elseif ($_POST['name']=="D05.SI"){
	  	$price = $dbs;
	  	}
	  	elseif ($_POST['name']=="039.SI"){
	  	$price = $ocbc;
	  	}
	  	elseif ($_POST['name']=="TRI"){
	  	$price = $tri;
	  	}
	  	elseif ($_POST['name']=="MSFT"){
	  	$price = $msft;
	  	}
	  	else{
	  	$price = "";
	  	}
	}
}

?>