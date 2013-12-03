<?php

$userArriveBySubmittingAForm = !empty($_POST);

if ($userArriveBySubmittingAForm) {

	$nameNotSelected = empty($_POST['name']); //Empty post
	if ($nameNotSelected) {
		$errors['name'] = "Please select an equity"; //If no name selected
	}
	
	$noquantity = empty($_POST['quantity']); //Empty post
	$quantityNotNumeric = !is_numeric($_POST['quantity']); //Post not numeric
	$quantityIsNegative = ($_POST['quantity']<0); //Post is negative

	//Error messages
	if ($noquantity) {
		$errors['quantity'] = "Please enter the quantity you wish to purchase";
	} elseif ($quantityNotNumeric) {
		$errors['quantity'] = "Quantity entered is not a number";
	} elseif ($quantityIsNegative) {
		$errors['quantity'] = "Quantity entered should not be negative";
	}
	
	$orderNotSelected = empty($_POST['order']); //Empty post
	if ($orderNotSelected) {
		$errors['order'] = "Please select an order"; //If no order selected
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
	  	$price = "ERROR!!";
	}
	
	if ($_POST['order']=="Stop Loss"){
		$orderpriceMoreThanCurrentPrice = ($_POST['orderPrice']>=$price); //Post more than or equal to current price
	} elseif ($_POST['order']=="Market"){
		$orderpriceNotEqualCurrentPrice = ($_POST['orderPrice']!=$price); //Post not equal to current price
	}
	
	$noorderPrice = empty($_POST['orderPrice']); //Empty post
	$orderpriceNotNumeric = !is_numeric($_POST['orderPrice']); //Post not numeric
	$orderpriceIsNegative = ($_POST['orderPrice']<0); //Post is negative

	//Error messages
	if ($noorderPrice) {
		$errors['orderPrice'] = "Please enter the price in which the order would be executed at";
	} elseif ($orderpriceNotNumeric) {
		$errors['orderPrice'] = "Price entered is not a number";
	} elseif ($orderpriceIsNegative) {
		$errors['orderPrice'] = "Price entered should not be negative";
	} elseif ($orderpriceMoreThanCurrentPrice) {
		$errors['orderPrice'] = "Price entered must be less than the current price";
	} elseif ($orderpriceNotEqualCurrentPrice) {
		$errors['orderPrice'] = "Price entered must be equal to the current price";
	}
	
	$noErrors = (count($errors) == 0);
	$haveErrors = !$noErrors;

	//No errors
	if ($noErrors) {
		if (!empty($_POST['name'])) { //Get name
			$name = $_POST['name'];
		}
		if (!empty($_POST['quantity'])) { //Get quantity
			$quantity = $_POST['quantity'];
		}
		if (!empty($_POST['order'])) { //Get order
			$order = $_POST['order'];
		}
		if (!empty($_POST['orderPrice'])) { //Get order price
			$orderPrice = $_POST['orderPrice'];
		}
	}
}

?>