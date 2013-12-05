<?php

	//Define variables
    $blumont = '';
    $ezra = '';
    $goldenagr = '';
    $viking = '';
    $noble = '';
    $rex = '';
    $dragon = '';
    $liongold = '';
    $singtel = '';
    $skyone = '';
    $vallianz = '';
    $gentingsp = '';
    $capitaland = '';
    $siic = '';
    $gentinghk = '';
    $yangzijiang = '';
    $asiasons = '';
    $glp = '';
    $capmallsasia = '';
    $ezionhldg = '';
  
    class yahooEquity
    {
  
    	function getEquity($equity, $cache)
  		{
  			return $this->generate_equity_array($equity);   
  		} 
     
  		function generate_equity_array($equity) //Create array
  		{	
  			global $blumont,$ezra,$goldenagr,$viking,$noble,$rex,$dragon,$liongold,$singtel,$skyone,$vallianz,$gentingsp,$capitaland,$siic,$gentinghk,$yangzijiang,$asiasons,$glp,$capmallsasia,$ezionhldg;

			$row = 1;
			if (($handle = fopen($equity, "r")) !== FALSE) 
			{
    			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    			{
        			$row++;
       				for ($c=0; $c < 1; $c++) //Getting data
        			{
        				if ($data[$c]=="A33.SI") { 
							$blumont = $data[$c+1];
						} elseif ($data[$c]=="P05.SI") {
							$ezra = $data[$c+1];
						} elseif ($data[$c]=="E5H.SI") {
							$goldenagr = $data[$c+1];
						} elseif ($data[$c]=="557.SI") {
							$viking = $data[$c+1];
						} elseif ($data[$c]=="N21.SI") {
							$noble = $data[$c+1];
						} elseif ($data[$c]=="5WH.SI") {
							$rex = $data[$c+1];
						} elseif ($data[$c]=="MT1.SI") {
							$dragon = $data[$c+1];
						} elseif ($data[$c]=="A78.SI") {
							$liongold = $data[$c+1];
						} elseif ($data[$c]=="Z74.SI") {
							$singtel = $data[$c+1];
						} elseif ($data[$c]=="5MM.SI") {
							$skyone = $data[$c+1];
						} elseif ($data[$c]=="545.SI") { 
							$vallianz = $data[$c+1];
						} elseif ($data[$c]=="G13.SI") {
							$gentingsp = $data[$c+1];
						} elseif ($data[$c]=="C31.SI") {
							$capitaland = $data[$c+1];
						} elseif ($data[$c]=="5GB.SI") {
							$siic = $data[$c+1];
						} elseif ($data[$c]=="S21.SI") {
							$gentinghk = $data[$c+1];
						} elseif ($data[$c]=="BS6.SI") {
							$yangzijiang = $data[$c+1];
						} elseif ($data[$c]=="5ET.SI") {
							$asiasons = $data[$c+1];
						} elseif ($data[$c]=="MC0.SI") {
							$glp = $data[$c+1];
						} elseif ($data[$c]=="JS8.SI") {
							$capmallsasia = $data[$c+1];
						} else {
							$ezionhldg = $data[$c+1];
						}
					}		
    			}
   			}
    	  	fclose($handle);
  		}
    }  
    
    $equities = new yahooEquity();
  
    $equities->getEquity("http://download.finance.yahoo.com/d/quotes.csv?s=A33.SI+5DN.SI+E5H.SI+557.SI+N21.SI+5WH.SI+MT1.SI+A78.SI+Z74.SI+5MM.SI+545.SI+G13.SI+C31.SI+5GB.SI+S21.SI+BS6.SI+5ET.SI+MC0.SI+JS8.SI+5ME.SI&f=sl1", "n"); //Get equities last trade

?>  