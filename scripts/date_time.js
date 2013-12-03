  function date_time(id)
  {
	date = new Date;
	year = date.getFullYear();        
	month = date.getMonth();       
	months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');       
	d = date.getDate();       
	day = date.getDay();    
	days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');   
	h = date.getHours();
	
	if(h<10)   
	{  
		h = "0"+h;       
	}   

	m = date.getMinutes();
    
	if(m<10)   
	{  
		m = "0"+m;       
	}
    
	s = date.getSeconds();
    
	if(s<10)   
	{   
		s = "0"+s;       
	}
    
	result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;    
	document.getElementById(id).innerHTML = result;  
	setTimeout('date_time("'+id+'");','1000');
    return true;
  }
  
  <!doctype html>
  <html lang="en">
  <meta charset= "utf-8">
  <title>US Time Zones</title>
  <style>
  p{max-width:500px;font-size:1.05em}
  </style>
  <script>

  Date.short_months= ['Jan', 'Feb', 'Mar', 'Apr', 'May',
  'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  Date.tzones={
      N:['Newfoundland', -210],
      A:['Atlantic', -240],
      E:['Eastern', -300],
      C:['Central', -360],
      M:['Mountain', -420],
      P:['Pacific', -480],
      AK:['Alaska', -540],
      HA_:['Hawaii-Aleutian (Aleutian)', -600],
      HA:['Hawaii-Aleutian (Hawaii)', -600, -600]
  };
  Date.dstOff= function(d, tz){
      var off= tz[1], doff= tz[2],
      countstart, countend, dstart, dend,
      y= d.getUTCFullYear();
      if(y>2006 && off!== doff){
          countstart= 8, countend= 1,
          dstart= new Date(Date.UTC(y, 2, 8, 2)),
          dend= new Date(Date.UTC(y, 10, 1, 2));
          while(dstart.getUTCDay()!== 0){
              dstart.setUTCDate(++countstart);
          }
          while(dend.getUTCDay()!== 0){
              dend.setUTCDate(++countend);
          }
          dstart.setUTCMinutes(off);
          dend.setUTCMinutes(off);
          if(dstart<= d && dend>= d) off= doff;
      }
      return off;
  }
  Date.toTZString= function(d, tzp){
      d= d? new Date(d):new Date();
      tzp= tzp || 'G';
      var h, m, s, pm= 'pm', off, dst, str,
      label= tzp+'ST',
      tz= Date.tzones[tzp.toUpperCase()];
      if(!tz) tz= ['Greenwich', 0, 0];
      off= tz[1];
      if(off){
          if(tz[2]== undefined) tz[2]= tz[1]+60;
          dst= Date.dstOff(d, tz);
          if(dst!== off) label= tzp+'DT';
          d.setUTCMinutes(d.getUTCMinutes()+dst);
      }
      else label= 'GMT';
      h= d.getUTCHours();
      m= d.getUTCMinutes();
      if(h>12) h-= 12;
      else if(h!== 12) pm= 'am';
      if(h== 0) h= 12;
      if(m<10) m= '0'+m;
      var str= Date.short_months[d.getUTCMonth()]+' '+d.getUTCDate()+', ';
      return str+ h+':'+m+' '+pm+' '+label.replace('_', '').toUpperCase();
  }
  window.onload=function(){
      var who=document.getElementById('CentralTimer');
      who.firstChild.data= Date.toTZString('', 'C');
      Date.ctclock= setInterval(function(){
          var v=who.firstChild.data,
          t=Date.toTZString('', 'C');
          if(v!=t) who.firstChild.data=t;
      },1000);
  who.ondblclick=function(){
      clearInterval(Date.ctclock);
      who.firstChild.data+=' (Clock Stopped)';
  }
  }
  </script>
  </head>
  <body>
  <h4 id="CentralTimer">Central Time</h4>

  </body>
  </html> 