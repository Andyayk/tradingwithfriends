<?php

  $aapl = '';
  $fb = '';
  $dbs = '';
  $ocbc = '';
  $tri = '';
  $msft = '';
  
  class yahooEquities
  {
  
  function getEquities($equity, $cache)
  {
  	return $this->generate_equity_array($equity);   
  } 
     
  function generate_equity_array($equity) //Create array
  {	
  	global $aapl,$fb,$dbs,$ocbc,$tri,$msft;

	$row = 1;
	if (($handle = fopen($equity, "r")) !== FALSE) 
	{
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    	{
        	$row++;
       		for ($c=0; $c < 1; $c++) //Getting data
        	{
				if ($data[$c]=="AAPL") 
				$aapl = $data[$c+1];
				elseif ($data[$c]=="FB")
				$fb = $data[$c+1];
				elseif ($data[$c]=="D05.SI")
				$dbs = $data[$c+1];
				elseif ($data[$c]=="O39.SI")
				$ocbc = $data[$c+1];
				elseif ($data[$c]=="TRI")
				$tri = $data[$c+1];
				else
				$msft = $data[$c+1];
			}		
    	}
   	}
    	  fclose($handle);
  }
  }  
  $equities = new yahooEquities();
  
  $equities->getEquities("http://download.finance.yahoo.com/d/quotes.csv?s=AAPL+FB+D05.SI+O39.SI+TRI+MSFT&f=sl1", "n"); //Get equities last trade

?>  