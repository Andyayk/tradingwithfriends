<?php

  //Define variables
  $blumont = '';
  $pfood = '';
  $goldenagr = '';
  $viking = '';
  $noble = '';
  $rex = '';
  $dragon = '';
  $liongold = '';
  $singtel = '';
  $skyone = '';
  
  class yahooEquities
  {
  
  function getEquities($equity, $cache)
  {
  	return $this->generate_equity_array($equity);   
  } 
     
  function generate_equity_array($equity) //Create array
  {	
  	global $blumont,$pfood,$goldenagr,$viking,$noble,$rex, $dragon,$liongold,$singtel,$skyone;

	$row = 1;
	if (($handle = fopen($equity, "r")) !== FALSE) 
	{
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    	{
        	$row++;
       		for ($c=0; $c < 1; $c++) //Getting data
        	{
				if ($data[$c]=="A33.SI") 
				$blumont = $data[$c+1];
				elseif ($data[$c]=="P05.SI")
				$pfood = $data[$c+1];
				elseif ($data[$c]=="E5H.SI")
				$goldenagr = $data[$c+1];
				elseif ($data[$c]=="557.SI")
				$viking = $data[$c+1];
				elseif ($data[$c]=="N21.SI")
				$noble = $data[$c+1];
				elseif ($data[$c]=="5WH.SI")
				$rex = $data[$c+1];
				elseif ($data[$c]=="MT1.SI")
				$dragon = $data[$c+1];
				elseif ($data[$c]=="A78.SI")
				$liongold = $data[$c+1];
				elseif ($data[$c]=="Z74.SI")
				$singtel = $data[$c+1];
				else
				$skyone = $data[$c+1];
			}		
    	}
   	}
    	  fclose($handle);
  }
  }  
  $equities = new yahooEquities();
  
  $equities->getEquities("http://download.finance.yahoo.com/d/quotes.csv?s=A33.SI+P05.SI+E5H.SI+557.SI+N21.SI+5WH.SI+MT1.SI+A78.SI+Z74.SI+5MM.SI&f=sl1", "n"); //Get equities last trade

?>  