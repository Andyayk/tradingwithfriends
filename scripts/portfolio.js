var refreshTimer;
var REFRESH_DELAY = 1000;
var portfolioShares = [];
var tradeResult = null;


function init() {
    updateTradeResult();
    toggleRefresh();
}


function updateTradeResult() {
    if (tradeResult) {
      var resultElement = getTradeResultElement();
      resultElement.toggleClassName (tradeResult > 0 ? 'increase' : 'decrease');
      resultElement.setTextValue (formatMoney(tradeResult));
    }
}

function toggleRefresh() {

    var button = document.getElementById('toggle-refresh');

    if (refreshTimer) {
      clearInterval(refreshTimer);
      refreshTimer = null;
      button.setTextValue('Start refresh');
    } else {
      refreshTimer = setInterval(refreshPrices, REFRESH_DELAY);    
      button.setTextValue('Pause refresh');
    }      
}


function refreshPrices() {

    var ajax = new Ajax();
    ajax.responseType = Ajax.JSON;

    ajax.ondone = function (data) {
      updateStockPrices (data.stocks);
    }

    ajax.onerror = onStockListError; 

    ajax.requireLogin = 1;
    ajax.post (STOCK_PRICE_AJAX_URL);
}

function onStockListError() {
    out("An error occurred while retrieving the updated stock list.");
}

function updateStockPrices(stocks) {
  out ('updateStockPrices');
    var total = 0.0;
    for (var i=0; i < stocks.length; i++) {
	var stock = stocks[i];

	// calculate the user's total value for this stock
	var rowTotal = getStockValue (stock);

	// if they have one for it, update the total
	if (rowTotal) {
	  total += rowTotal;
	}

	// update price
	getStockPriceElement(stock).setTextValue (formatMoney (getStockPrice (stock)));

	// update row total	
	getStockRowTotalElement(stock).setTextValue (rowTotal ? formatMoney (rowTotal) : '');

	// update total
	getTotalElement().setTextValue (formatMoney (total));  
    }
}

function getStockPriceElement (stock) {
  return document.getElementById('stock-price-' + getStockId (stock));
}

function getStockRowTotalElement (stock) {
  return document.getElementById('stock-total-' + getStockId (stock));
}

function getTotalElement() {
  return document.getElementById('total');
}

function getStockId (stock) {
  return stock.id;
}

function getStockPrice (stock) {
  return stock.price;
}

function getStockShares (stock) {
  return portfolioShares[stock.id];
}

function getStockValue (stock) {
  return getStockPrice(stock) * getStockShares(stock);
}

function getTradeResultElement() {
  return document.getElementById('trade-result');
}


function out(out) {
    document.getElementById('console').setTextValue (out);
}

function formatMoney(price) {

  var sign = price < 0 ? '-' : '';
  
  var dollars = Math.floor(Math.abs(price) / 100);
  
  // note: in FBJS, new String(number) did not work
  var dollarsString = dollars.toString();
  
  var cents = Math.abs(price) % 100;    
  
  var centsString = (cents < 10 ? "0" : "") + cents.toString();
  
  var signString = (price < 0 ? '-' : '');

  return signString + "$" + dollarsString  + "." + centsString;
}
