<?php

$userArriveBySubmittingAForm = !empty($_POST);

if ($userArriveBySubmittingAForm) {

	$nameNotSelected = empty($_POST['name']); //Empty post
	if ($nameNotSelected) {
		$errors['name'] = "Please select an equity"; //If no name selected
	}
	
	$noquantity = empty($_POST['quantity']); //Empty post
	$quantityNotNumeric = !is_numeric($_POST['quantity']); //Post not numeric
	$quantityNotInRange = ($_POST['quantity']<0); //Post not in range

	//Error messages
	if ($noquantity) {
		$errors['quantity'] = "Please enter the quantity you wish to purchase";
	} elseif ($quantityNotNumeric) {
		$errors['quantity'] = "Quantity entered is not a number";
	} elseif ($quantityNotInRange) {
		$errors['quantity'] = "Quantity entered is not in range";
	}
	
	$orderNotSelected = empty($_POST['order']); //Empty post
	if ($orderNotSelected) {
		$errors['order'] = "Please select an order"; //If no order selected
	}
	
	$noorderPrice = empty($_POST['orderPrice']); //Empty post
	$orderpriceNotNumeric = !is_numeric($_POST['orderPrice']); //Post not numeric
	$orderpriceNotInRange = ($_POST['orderPrice']<0); //Post not in range

	//Error messages
	if ($noorderPrice) {
		$errors['orderPrice'] = "Please enter the price you wish to execute the trade";
	} elseif ($orderpriceNotNumeric) {
		$errors['orderPrice'] = "Price entered is not a number";
	} elseif ($orderpriceNotInRange) {
		$errors['orderPrice'] = "Price entered is not in range";
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