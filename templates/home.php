<?php namespace ProcessWire; 
/**
 * home.php
 * This file is the home page template file. 
 * It includes markup for a carousel slider after the site header and nav menu
 */

// Primary content is the page body copy
$content = $page->body;
// set news & events section using that page
$fbpage = $pages->get("/feedback/");
// set events section using that page
$newspg = $pages->get("/news/");
$eventspg = $pages->get("/events/");

// find the feedback records - (they are children of the feedback page)
$feedback = $fbpage->children();
// if there is some feedback, grab one at random for display
$fb1 = '<p>No feedback currently available</p>'; 
if ($feedback) {
	$fb1 = $feedback->getRandom();
	// if there is an image of couple use it else use the stock img on fb page
	if (count($fb1->images)) {
   	$img = $fb1->images->first;
   }
   else {
   	$img = $fbpage->couple_anon;
   }
}

$img = $img->size(110,145);
$nonJsimg = "<img class='fb-panel img-circle img-responsive' src='$img->url' alt='$img->description' title='$img->description'>";	   			 					   			 	

// if there is a background image for feedback panel use it
$fb_bg = '';
if ($page->feedback_bg) {
	$fb_bg = "background-image: url('{$page->feedback_bg->url}')"; 
}

// get the image change timer 
$tm = $page->timer;
if ($tm < 1) $tm = 1;
if ($tm > 60) $tm = 60;
$tm *= 1000; // millisecs

?>
<!-- bring in a carousel slider -->
<div class="container-fluid" style="padding:0">
	<div class="row-fluid">
	<?php include('_carousel.php'); ?>
	</div>
</div>


<main id='main'>
<!-- main content -->
<div id="home">
	<div class="jumbotron">
	  <div class="container text-center">
	    <?php
	    	echo "<h1>$title</h1>"; 
	    	echo $content; 
	    ?>   
	    <noscript><?php echo "<div class='nojs'>$noJSavail</div>"; ?></noscript>
	  </div>
	</div>
	

  <div class="container-fluid">	
	 <!-- Featured images section -->
	  <div class="row text-center">
		  <div class="col-sm-4">
		  		<?php
			    $image = $page->images->first;		
			    if (!$image) $image = $notfoundimg;			    	    			    
			    $out_img = sizeImage($image);			   	
			    echo "<figure class='figure'>";	    	    			    	
		  		 echo "<a href='https://www.matrimonio.com/partecipazioni-nozze/mastergraph--e114716' target='_blank'><img src='$out_img->url' class='img-responsive' alt='$out_img->description' title='$out_img->description'></a>"; 
				 echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
				 echo "</figure>";
			    ?>
		  </div>
		  <div class="col-sm-4">
		  		<?php
			    $image = $page->images->getNext($image);
			    if (!$image) $image = $notfoundimg;			    
			    $out_img = sizeImage($image);			   	
			    echo "<figure class='figure'>";	    	    			    		    
		  		 echo "<img src='$out_img->url' class='img-responsive' alt='$out_img->description' title='$out_img->description'>"; 
				 echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
				 echo "</figure>";
			    ?>
		  </div>
  		  <div class="col-sm-4">
		  		<?php
			    $image = $page->images->getNext($image);
			    if (!$image) $image = $notfoundimg;
			    $out_img = sizeImage($image);			   	
			    echo "<figure class='figure'>";	    	    			    		    	    
		  		 echo "<img src='$out_img->url' class='img-responsive' alt='$out_img->description' title='$out_img->description'>"; 
				 echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
				 echo "</figure>";
			    ?>
		  </div>
	  </div>
	  
		<!-- News section -->	  
		<div class="row text-center">
			<div class="jumbotron text-center">
			    <?php echo "<h2>$newspg->title</h2>"; ?>   
		   </div>
			<div class="col-sm-4">
			<?php
				 $image = $page->newsevents->first;
			    if (!$image) $image = $notfoundimg;			    	    			    
			    $out_img = sizeImage($image);			   	
			    echo "<figure class='figure'>";	    	    			    		    	    		    
				 echo "<a href='$eventspg->url'><img class='img-responsive' src='{$out_img->url}' alt='{$out_img->description}' title='{$out_img->description}' ></a>";
				 echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
				 echo "</figure>";
			 ?>
			</div>
			<div class="col-sm-4">
			<?php
				 $image = $page->newsevents->getNext($image);
				 if (!$image) $image = $notfoundimg;			    	    			    
			    $out_img = sizeImage($image);			   	
			    echo "<figure class='figure'>";	    	    			    		    	    			    		    
				 echo "<a href='$eventspg->url'><img class='img-responsive' src='{$out_img->url}' alt='{$out_img->description}' title='{$out_img->description}' ></a>";
				 echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
				 echo "</figure>";
			 ?>
			</div>
			<div class="col-sm-4">
			<?php
				 $image = $page->newsevents->getNext($image);
				 if (!$image) $image = $notfoundimg;			
			    $out_img = sizeImage($image);			   	
			    echo "<figure class='figure'>";	    	    			    		    	    			    	    				     	    			    
				 echo "<a href='$newspg->url'><img class='img-responsive' src='{$out_img->url}' alt='{$out_img->description}' title='{$out_img->description}' ></a>";
				 echo "<figcaption class='figure-caption text-center'>{$out_img->description}</figcaption>";
				 echo "</figure>";
			 ?>
			</div>
		</div>

	  <!-- Testimonials section -->	  
		<div class="row text-center">
			<div class="jumbotron text-center">
			    <?php echo "<h2>$fbpage->title</h2>"; ?>   
		   </div>
		</div>
			<div class="row" style="min-height:200px; <?php echo $fb_bg; ?>"> 
				<div class="col-lg-1 col-lg-offset-2 text-center" >
	  		    	<div id="fb-img">
	  		    	<noscript><?php echo $nonJsimg; ?></noscript>
				   </div>
				</div>
			<div class="fb-panel col-lg-9">
				<div id="fbtext" style="height:150px">
				<noscript><?php echo $fb1->testimonial; ?></noscript>
				</div>
				<?php echo "<a href='$fbpage->url' class='btn btn-info' role='button'>$page->moreButtonText</a>"; ?>				
			</div>
		</div>
	</div>
 </div> 
</main>

<script src="<?php echo $config->urls->templates?>js/k4u-home-min.js"></script>

<script>
// webservice is the page being requested by ajax call 
var webservice = <?php echo "'{$page->url}webservice/'"; ?>;
var changeTm = <?php echo $tm; ?>;
var noSlides = <?php echo $page->sliders->count(); ?>;
var rowCnt = 0; // table row count returned from Ajax response    
var sel = 'home'; // page id for ajax handler
var fbs = 1; 
</script> 
