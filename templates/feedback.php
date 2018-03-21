<?php namespace ProcessWire;

// feedback.php template file 
// The testimonials are children of this page in 'couples' template 
$children = $page->children();
$nc = $page->numChildren; 

// if there are featured images, lets choose one to output at random 
if(count($page->images)) {
	// if the page has images on it, grab one of them randomly... 
	$image = $page->images->getRandom();
}
else {
	$image = $notfoundimg;
} 

// resize fixed width required 
$image = $image->width(300); 

// hack to handle language switch. No idea why this is needed only on this page!
$lang = ''; 
if (strpos($page->url, 'en/')){
	$lpath = "'{$config->urls->root}en/webservice/'";
}
else {
	$lpath = "'{$config->urls->root}webservice/'";
} 

// Primary content is the page's body copy
$content = $page->body; 
// feedback text is built in main loop
$fbOnPg = $page->feedbacks_on_page;
$feedback = '';

?>

<!-- main content -->
<main>
	<div id="feedback">
		<div class="jumbotron">
		  <div class="container text-center">
		    <?php echo "<h1>$title</h1>"; ?>   
		  </div>
		</div>

	  <div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
				<?php echo $content; ?>
				</div>
			</div>		  
	  	
		  <div class="row">
			  <div class="col-lg-4 text-center" >
			  		<?php 
			  		echo "<img class='img-rounded' src='$image->url' alt='$image->description' title='$image->description'>";
			  		if ($image->description) echo "<p><span style='color:red' class='glyphicon glyphicon-heart'></span> $image->description</p>"; 
	  				?>
					<button id='more' onclick='pager()' class='btn btn-info'><?php echo $homepage->moreButtonText; ?></button>   									  	
			  </div>

				<div class="col-lg-8">
					<p id="pgind"></p>
					<div id="fb-text" style="min-height:500px">
					</div>
				</div>				 
			</div>
	 	</div>
	</div>

</main>

<script src="<?php echo $config->urls->templates?>js/k4u-feedback-min.js"></script>

<script>
// webservice is the page being requested by ajax call 
var webservice = <?php echo $lpath; ?>;
var fbPerPg = <?php echo $fbOnPg; ?>;
var rowCnt = 0; // table row count returned from Ajax response    
var fbs = 0;
var pc = 1;
var childs = <?php echo $nc; ?>;
var np = childs / fbPerPg; 
var noPgs = parseInt(np); 
// allow for a partial page count
if ((np-noPgs) > 0.0) {
	noPgs++;
}
</script>

