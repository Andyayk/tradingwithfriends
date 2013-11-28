<?php

$userArriveBySubmittingAForm = !empty($_POST);

$userArriveByClickingOrDirectlyTypeURL = !$userArriveBySubmittingAForm; //Arrive by URL is not the same as submitting a form

if ($userArriveBySubmittingAForm) {

	$nameNotSelected = empty($_POST['name']); //Empty post
	if ($nameNotSelected) {
		$errors['sellName'] = "Please select an equity"; //If no name selected
	}
	
	$noquantity = empty($_POST['sellQuantity']); //Empty post
	$quantityNotNumeric = !is_numeric($_POST['sellQuantity']); //Post not numeric
	$quantityNotInRange = ($_POST['sellQuantity']<0); //Post not in range

	//Error messages
	if ($noquantity) {
		$errors['sellQuantity'] = "Please enter the quantity you wish to purchase";
	} elseif ($quantityNotNumeric) {
		$errors['sellQuantity'] = "Quantity entered is not a number";
	} elseif ($quantityNotInRange) {
		$errors['sellQuantity'] = "Quantity entered is not in range";
	}
	
	$noErrors = (count($errors) == 0);
	$haveErrors = !$noErrors;

	//No errors
	if ($noErrors) {
		if (!empty($_POST['sellName'])) { //Get name
			$name = $_POST['sellName'];
		}
		if (!empty($_POST['sellQuantity'])) { //Get quantity
			$quantity = $_POST['sellQuantity'];
		}

		//Get price
	    require 'scripts/equity_price.php';
	  	if ($_POST['name']=="Blumont, A33.SI"){
	  	$price = $blumont;
	  	} elseif ($_POST['name']=="PFood, P05.SI"){
	  	$price = $pfood;
	  	} elseif ($_POST['name']=="GoldenAgr, E5H.SI"){
	  	$price = $goldenagr;
	  	} elseif ($_POST['name']=="$ Viking, 557.SI"){
	  	$price = $viking;
	  	} elseif ($_POST['name']=="Noble Grp, N21.SI"){
	  	$price = $noble;
	  	} elseif ($_POST['name']=="$ Rex Intl, 5WH.SI"){
	  	$price = $rex;
	  	} elseif ($_POST['name']=="Dragon Gp, MT1.SI"){
	  	$price = $dragon;
	  	} elseif ($_POST['name']=="LionGold, A78.SI"){
	  	$price = $liongold;
	  	} elseif ($_POST['name']=="Singtel, Z74.SI"){
	  	$price = $singtel;
	  	} elseif ($_POST['name']=="$ Sky One, 5MM.SI"){
	  	$price = $skyone;
	  	} else{
	  	$price = "";
	  	}
	}
}

?>