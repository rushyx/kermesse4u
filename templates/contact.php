<?php namespace ProcessWire;

// contact.php template file 
// Kermesse contact page
// Primary content is the page's body copy
$content = $page->body; 
// backup map image for non JS 
$map = ($page->images->first) ? $page->images->first : $notfoundimg;

?>

<main id='main'>
<!-- main content -->
	<div id="contact">
		<div class="jumbotron">
		  <div class="container text-center">
		    <?php echo "<h1>$title</h1>";  ?>
		  </div>
		</div>
	
	  <div class="container">	
		  <div class="row">
			  <div class="col-md-8" style='padding:10px 0'>
			  	  <noscript>
			  	  <?php 
			  	  echo "<div class='nojs'>$noJSavail</div>";
				  echo "<a href='https://maps.google.co.uk/maps?ie=UTF8&amp;cid=4286896971814889849&amp;q=Kermesse&amp;iwloc=A&amp;gl=GB&amp;hl=en_uk' target= '_blank'><img src='{$map->url}' alt='{$map->description}' title='Kermesse Google maps'></a>";			  	  
			  	  ?>
			  	  </noscript> 
		  		  <div class="google-maps">
			  		  <iframe width="600" height="400" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Kermesse&nbsp;Wedding&nbsp;Planner&key=AIzaSyDbfozrBV2bPwyGfgQb7skXxw08otGT0wo" allowfullscreen></iframe>
		  		  </div>		  		
			  </div>
			  <div class="col-md-4" style='padding-left:40px'>
			  		<?php 
			  		echo $content;
			  		echo "<p style='padding:10px 0'><a href='mailto:{$page->email}'>{$page->email}</a></p>";
			  		echo "<h5>$page->trademark</h5>";
			  		?>
			  </div>
		  </div>
	  </div>
	</div>
</main>
