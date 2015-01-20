  <head>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>		
    <!--Script for Toggle on setting-->
    <script>
      $(document).ready(function(){
	$("#setting").click(function(){
	  $("#dropdown").toggle();
	});
      });
    </script>
  </head>
  
  <body>  
    <br>
    <br>
    <br>
    <!--Scrupt for Navigation-->  
    <ul id="nav">
      <li><a class="link" href="/GoldenRod/index.php">Instructions</a></li>
      <li><a class="link" href="/GoldenRod/return.php">Check Out</a></li>
      <li><a class="link" href="/GoldenRod/table.php">Book Log</a></li>
      <a id="setting" class="setting"><i class="icon-cog"></i> </a>
	<div id="dropdown"  class="dropdown">				
	   <a class="dropdownlink" href="/GoldenRod/login/php/logout.php">Logout</a> 
	</div>	
    </ul>
  </body>	
	