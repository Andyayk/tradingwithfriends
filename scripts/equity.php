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
	echo "	background-color: #90EE90; color: black; font-family:verdana;margin-top:0px;margin-bottom:4px;font-size:80%;";
	echo "}";
	echo "td.odd {";
	echo "	background-color: #90EE90; color: black; font-family:verdana;margin-top:0px;margin-bottom:4px;font-size:80%;";
	echo "}";
	echo "tr.head {";
	echo "color:#000000;background-color: #F0F0F0;font-family:verdana;margin-top:0px;margin-bottom:8px;font-size:80%;";
	echo "}";
	echo "</style>";
	echo "<table border=1 cellspacing=1 cellpadding=2>";
	echo "<tr class=head><th>Name</th><th>Symbol</th><th>Last Trade</th><th>Open</th><th>Close</th><th>Change</th><th>Bid</th><th>Ask</th>
	<th>Day's Low</th><th>Day's High</th><th>52wk Low</th><th>52wk High</th><th>Last Trade Date</th><th>Last Trade Time</th><th>Chart</th></tr>";
			
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
				if ($row%2==0)
				{
					echo "<td class=even>"; //Even rows
					if ($data[5]<0&&($c==5||$c==2||$c==1)) //Finding negative equities' changes, last trade & name
						echo "<font color=red>";
					else	
					{
						if ($data[5]>0&&($c==5||$c==2||$c==1)) //Finding positive equities' changes, last trade & name
						echo "<font color=green>";
					}
					echo $data[$c]."</font>"; //Colouring of positive/negative equities changes, last trade & name
					if (($c+1)==$num)//Printing of charts
					{
						echo "</td><td class=even><img src=http://ichart.finance.yahoo.com/h?s=".$data[1]."&lang=en-SG&region=sg></td>";
					}
					else 
					echo "</td>";
				}
				else
				{
					echo "<td class=odd>"; //Odd rows
					if ($data[5]<0&&($c==5||$c==2||$c==1)) //Finding negative equities' changes, last trade & name
						echo "<font color=red>";
					else
					{
						if ($data[5]>0&&($c==5||$c==2||$c==1)) //Finding positive equities' changes, last trade & name
						echo "<font color=green>";
					}
					echo $data[$c]."</font>"; //Colouring of positive/negative equities changes, last trade & name
					if (($c+1)==$num)//Printing of charts
					{
						echo "</td><td class=odd><img src=http://ichart.finance.yahoo.com/h?s=".$data[1]."&lang=en-SG&region=sg></td>";
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
  
  $equities->get_equities("http://download.finance.yahoo.com/d/quotes.csv?s=A33.SI+P05.SI+E5H.SI+557.SI+N21.SI+5WH.SI+MT1.SI+A78.SI+Z74.SI+5MM.SI&f=nsl1opc6baghjkd1t1", "n"); //Get equities

?>  