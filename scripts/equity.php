<?php

  echo "<html>".header('Refresh: 300')."<head><body>";
  class yahoo_stocks {
  
  function get_stocks($stock, $cache)
  {
  	return $this->generate_stock_array($stock);   
  } 
     
  function generate_stock_array($stock)
  {
    echo "<style type=\"text/css\">";
	echo "td.even {";
	echo "	background-color: #FCF6CF; color: black; font-family:verdana;margin-top:0px;margin-bottom:4px;font-size:80%;";
	echo "}";
	echo "td.odd {";
	echo "	background-color: #FEFEF2; color: black; font-family:verdana;margin-top:0px;margin-bottom:4px;font-size:80%;";
	echo "}";
	echo "tr.head {";
	echo "color:#000000;
	background-color: #F0F0F0;
	font-family:verdana;
	margin-top:0px;
	margin-bottom:8px;
	font-size:80%;";
	echo "}";
	echo "</style>";
	echo "<table border=1 cellspacing=1 cellpadding=2>";
	echo "<tr class=head><td>Name</td><td>Last Trade</td><td>Open</td><td>% Change</td><td>Change</td><td>Day's Low</td><td>Day's High</td><td>Change 52wk Low</td><td>Change 52wk High</td><td>% Change 52wk Low</td><td>% Change 52wk High</td><td>52 low</td><td>52 high</td><td>Chart</td></tr>";
			
	$row = 1;
	if (($handle = fopen($stock, "r")) !== FALSE) 
	{
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    	{
        	$num = count($data);
			echo "<tr>";
        	$row++;
       		for ($c=0; $c < $num; $c++) 
        	{
				if($row%2==0)
				{
					echo "<td class=even>";
					if($data[4]<0&&($c==4||$c==1||$c==0))
						echo "<font color=red>";
					else	
					{
						if($data[4]>0&&($c==4||$c==1||$c==0))
						echo "<font color=green>";
					}
					echo $data[$c]."</font>";
					if(($c+1)==$num)
					{
						echo "</td><td class=even><img src=http://ichart.finance.yahoo.com/h?s=".$data[0]."&lang=en-IN&region=in></td>";
					}
				else 
					echo "</td>";
				}
					else
					{
						echo "<td class=odd>";
						if($data[4]<0&&($c==4||$c==1||$c==0))
							echo "<font color=red>";
						else
						{
							if($data[4]>0&&($c==4||$c==1||$c==0))
								echo "<font color=green>";
						}
							echo $data[$c]."</font>";
							if(($c+1)==$num)
							{
								echo "</td><td class=odd><img src=http://ichart.finance.yahoo.com/h?s=".$data[0]."&lang=en-IN&region=in></td>";
							}
							else 
								echo "</td>";
					}
        	} 
   	 	} echo "</tr>";
			echo "</table>";
    		fclose($handle);
	}
  } 
  function get_stock_bundle($syms)
  {
  	foreach ($syms as $s) {
		$bundle[$s] = $this->generate_stock_array($s);
    } 
    	return $bundle;
    } 
  }  
  $stocks = new yahoo_stocks();
  
  $stocks->get_stocks("http://download.finance.yahoo.com/d/quotes.csv?s=AAPL+FB+MSFT&f=sl1ok2c6ghj5k4j6k5jk", "n");
  echo "</body></head></html>";    
?>  