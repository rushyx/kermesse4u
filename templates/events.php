<?php namespace ProcessWire;

// events.php template file 
// images on page are changed by js on a timer. 
// The js array cmsImages is initialised with images from the PW cms 
// by the php code below
$ni = sizeof($page->images);
$jsArr = '';
$jsTxt = '';
$i = 1;
foreach($page->images as $image) {
	$img = sizeImage($image);			   	
	$jsArr .= "'{$img->url}'";
	$jsTxt .= "'{$img->description}'";
	if($i++ < $ni){
		 $jsArr .= ',';
		 $jsTxt .= ',';
	}
}

if (!$jsArr) $jsArr = $notfoundimg->url;

// get the image change timer & no. of images (divs) to swap
$jsDivs = $page->imageSwaps;
if ($jsDivs < 0) $jsDivs = 0;
if ($jsDivs > 4) $jsDivs = 4;
 
$tm = $page->timer;
if ($tm < 1) $tm = 1;
if ($tm > 60) $tm = 60;
$tm *= 1000; // millisecs

// Primary content is the page's body copy
$content = $page->body; 
	
?>

<main id='main'>
	<div id="events">
	<!-- main content -->
		<div class="jumbotron">
		  <div class="container text-center">
		    <?php echo "<h1>$title</h1>"; ?>   
		  </div>
		</div>
	
	  <div class="container">	
		  <div class="row">
			  <div class="col-md-4 text-center">
			  		<?php 
				   $image = $page->images->first;		
				   if (!$image) $image = $notfoundimg;		
				   $out_img = sizeImage($image);			   	
				   echo "<figure class='figure'>";	    	    			    
			  		echo "<img id='autoChange_1' class='img-responsive' src='$out_img->url' alt='$out_img->description'>";
				   echo "<figcaption id='fig_1' class='figure-caption text-center'>{$out_img->description}</figcaption>";
				   echo "</figure>";
	
				   $image = $page->images->getNext($image);
				   if ($image) {
				   	$out_img = sizeImage($image);			   	
				   	echo "<figure class='figure'>";	    	    			    	    
				  		echo "<img id='autoChange_2' class='img-responsive' src='$out_img->url' alt='$out_img->description'>"; 
					   echo "<figcaption id='fig_2' class='figure-caption text-center'>{$out_img->description}</figcaption>";
					   echo "</figure>";
					}
					?>
				</div>
			   <div class="col-md-4">
			  		<?php echo $content; ?>
				</div>
	
			   <div class="col-md-4 text-center">
			  		<?php 
				   $image = $page->images->getNext($image);
				   if ($image) {	
				   	$out_img = sizeImage($image);			   	
					   echo "<figure class='figure'>";	    	    			    
				  		echo "<img id='autoChange_3' class='img-responsive' src='$out_img->url' alt='$out_img->description'>"; 
					   echo "<figcaption id='fig_3' class='figure-caption text-center'>{$out_img->description}</figcaption>";
					   echo "</figure>";
				   }
	
				   $image = $page->images->getNext($image);
				   if ($image) {	
				      $out_img = sizeImage($image);			   	
				   	echo "<figure class='figure'>";	    	    			    	    
				  		echo "<img id='autoChange_4' class='img-responsive' src='$out_img->url' alt='$out_img->description'>"; 
					   echo "<figcaption id='fig_4' class='figure-caption text-center'>{$out_img->description}</figcaption>";
					   echo "</figure>";
					}
					?>
				</div>
			  </div>
		  </div>
	</div>
</main>

<script src="<?php echo $config->urls->templates?>js/k4u-events-min.js"></script>

<script>
// Javascript image changer
var changeTm = <?php echo $tm; ?>;
var cmsImages = new Array (<?php echo $jsArr; ?>);
var imgDescript = new Array (<?php echo $jsTxt; ?>);
var divs = <?php echo $jsDivs; ?>; // no. of divs to change
var noImgs = 0;
var index = 0;
var dInx = 1;
var divId = '#autoChange_'; // div id prefix to target for url
var capId = '#fig_'; // div id prefix for fig. captions
</script>
