<?php

  class yahoo_equities
  {
  
  function get_equities($equity, $cache)
  {
  	return $this->generate_equity_array($equity);   
  } 
     
  function generate_equity_array($equity) //Create array
  {
    echo "<style type=\"text/css\">";
	echo "td.even {";
	echo "	background-color: #FCF6CF; color: black; font-family:verdana;margin-top:0px;margin-bottom:4px;font-size:80%;";
	echo "}";
	echo "td.odd {";
	echo "	background-color: #FEFEF2; color: black; font-family:verdana;margin-top:0px;margin-bottom:4px;font-size:80%;";
	echo "}";
	echo "tr.head {";
	echo "color:#000000;background-color: #F0F0F0;font-family:verdana;margin-top:0px;margin-bottom:8px;font-size:80%;";
	echo "}";
	echo "</style>";
	echo "<table border=1 cellspacing=1 cellpadding=2>";
	echo "<tr class=head><th>Name</th><th>Last Trade</th><th>Open</th><th>% Change</th><th>Change</th><th>Day's Low</th><th>Day's High</th>
	<th>Change 52wk Low</th><th>Change 52wk High</th><th>% Change 52wk Low</th><th>% Change 52wk High</th><th>52 low</th><th>52 high</th><th>Chart</th></tr>";
			
	$row = 1;
	if (($handle = fopen($equity, "r")) !== FALSE) 
	{
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    	{
        	$num = count($data); //Counting of data
			echo "<tr>";
        	$row++;
       		for ($c=0; $c < $num; $c++) //Getting data
        	{
				if($row%2==0)
				{
					echo "<td class=even>"; //Even rows
					if($data[4]<0&&($c==4||$c==1||$c==0)) //Finding negative equities' changes, last trade & name
						echo "<font color=red>";
					else	
					{
						if($data[4]>0&&($c==4||$c==1||$c==0)) //Finding positive equities' changes, last trade & name
						echo "<font color=green>";
					}
					echo $data[$c]."</font>"; //Colouring of positive/negative equities changes, last trade & name
					if(($c+1)==$num)//Printing of charts
					{
						echo "</td><td class=even><img src=http://ichart.finance.yahoo.com/h?s=".$data[0]."&lang=en-SG&region=sg></td>";
					}
				else 
					echo "</td>";
				}
					else
					{
						echo "<td class=odd>"; //Odd rows
						if($data[4]<0&&($c==4||$c==1||$c==0)) //Finding negative equities' changes, last trade & name
							echo "<font color=red>";
						else
						{
							if($data[4]>0&&($c==4||$c==1||$c==0)) //Finding positive equities' changes, last trade & name
								echo "<font color=green>";
						}
							echo $data[$c]."</font>"; //Colouring of positive/negative equities changes, last trade & name
							if(($c+1)==$num)//Printing of charts
							{
								echo "</td><td class=odd><img src=http://ichart.finance.yahoo.com/h?s=".$data[0]."&lang=en-SG&region=sg></td>";
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
 
  }  
  $equities = new yahoo_equities();
  
  $equities->get_equities("http://download.finance.yahoo.com/d/quotes.csv?s=AAPL+FB+D05.SI+O39.SI+TRI+MSFT&f=sl1ok2c6ghj5k4j6k5jk", "n"); //Get equities

?>  