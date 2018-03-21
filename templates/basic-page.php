<?php namespace ProcessWire;

// basic-page.php template file 

// Primary content is the page's body copy
$content = $page->body; 
	
?>

<main id='main'>
<!-- main content -->
	<div class="jumbotron">
	  <div class="container text-center">
	    <?php echo "<h1>$title</h1>"; ?>   
	  </div>
	</div>

  <div class="container">	
	  <div class="row">
		  <div class="col-lg-4 col-md-6 text-center" style="padding-top:15px">
		  		<?php 
			   $image = $page->images->first;		
			   if (!$image) $image = $notfoundimg;	
			   $out_img = sizeImage($image);			   	
			   echo "<figure class='figure'>";	    	    			    
		  		echo "<img class='img-responsive' src='$out_img->url' alt='$out_img->description' title='$out_img->description'>"; 
			   echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
			   echo "</figure>";

			   $image = $page->images->getNext($image);
			   if ($image) {	
			   	$out_img = sizeImage($image);			   	
			   	echo "<figure class='figure'>";	    	    			    	    
			  		echo "<img class='img-responsive' src='$out_img->url' alt='$out_img->description' title='$out_img->description'>"; 
				   echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
				   echo "</figure>";
				}
						
			   $image = $page->images->getNext($image);
			   if ($image) {	
			   	$out_img = sizeImage($image);			   	
			 		echo "<figure class='figure'>";	    	    			    	    	    
			  		echo "<img class='img-responsive' src='$out_img->url' alt='$out_img->description' title='$out_img->description'>"; 
				   echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
				   echo "</figure>";
				}
  				?>
		  </div>
		  <div class="col-lg-8 col-md-6">
		  		<?php echo $content; ?>
		  </div>
	  </div>
  </div>
</main>
