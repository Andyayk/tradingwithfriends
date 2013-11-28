<?php

$userArriveBySubmittingAForm = !empty($_POST);

if ($userArriveBySubmittingAForm) {

	$nameNotSelected = empty($_POST['sellName']); //Empty post
	if ($nameNotSelected) {
		$errors['sellName'] = "Please select an equity"; //If no name selected
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
	
	$noid = empty($_POST['id']); //Empty post
	$idNotNumeric = !is_numeric($_POST['id']); //Post not numeric
	$idNotInRange = ($_POST['id']<0); //Post not in range
	
	if ($noid) {
		$errors['id'] = "Please enter the ID of the equity you wish to sell"; //If no quantity
	} elseif ($idNotNumeric) {
		$errors['id'] = "ID entered is not a number"; //If id not is a number
	} elseif ($idNotInRange) {
		$errors['id'] = "ID entered is not in range"; //If id not is in range
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
		if (!empty($_POST['id'])) { //Get id
			$id = $_POST['id'];
		}

		//Get price
	    require 'scripts/equity_price.php';
	  	if ($_POST['sellName']=="Blumont, A33.SI"){
	  	$price = $blumont;
	  	} elseif ($_POST['sellName']=="PFood, P05.SI"){
	  	$price = $pfood;
	  	} elseif ($_POST['sellName']=="GoldenAgr, E5H.SI"){
	  	$price = $goldenagr;
	  	} elseif ($_POST['sellName']=="$ Viking, 557.SI"){
	  	$price = $viking;
	  	} elseif ($_POST['sellName']=="Noble Grp, N21.SI"){
	  	$price = $noble;
	  	} elseif ($_POST['sellName']=="$ Rex Intl, 5WH.SI"){
	  	$price = $rex;
	  	} elseif ($_POST['sellName']=="Dragon Gp, MT1.SI"){
	  	$price = $dragon;
	  	} elseif ($_POST['sellName']=="LionGold, A78.SI"){
	  	$price = $liongold;
	  	} elseif ($_POST['sellName']=="Singtel, Z74.SI"){
	  	$price = $singtel;
	  	} elseif ($_POST['sellName']=="$ Sky One, 5MM.SI"){
	  	$price = $skyone;
	  	} else{
	  	$price = "";
	  	}
	}
}

?>