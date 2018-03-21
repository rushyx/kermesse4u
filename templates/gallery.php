<?php namespace ProcessWire;

// gallery.php template file 

// Primary content is the page's body copy
$content = $page->body; 

$noAlbums = $page->numChildren;

?> 
<main id='main'>
<!-- main content -->
<div id="galleria">
	<div class="jumbotron">
	  <div class="container">
	    <?php echo "<h1>$title</h1>"; ?>   
	  </div>
	</div>
   <div class="container">
	  	<div class="row">
	  		<?php echo $content; ?>
	  	</div> 	
		  <div class="row"> 
			  <div class="col-lg-12"> 
					<div class="slideshow-container">	
					<?php
						$i = 1;
						foreach($page->children() as $child) {
							$cover = ($child->cover) ? $child->cover : $notfoundimg;
							$cover = $cover->size(800,533);
							echo "<div class='mySlides fader'>";
							echo "<div class='numbertext'>$i / $noAlbums</div>";
							echo "<figure class='figure'>";
						   echo "<img src='{$cover->url}' style='width:100%'>";
						   echo "<figcaption class='figure-caption text-center'>{$child->title}</figcaption>";
						   echo "</figure>";
							echo "</div>";
							$i++;
	
					}
					?>				
					
						<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						<a class="next" onclick="plusSlides(1)">&#10095;</a>
					
					</div>
	
	
					<div style='text-align:center; margin:5px 0'>
					<?php
						for($i = 1; $i <= $noAlbums; ++$i) {
							$name = $page->children()->eq($i-1)->title;
					  		echo "<span class='dot' data-toggle='tooltip' title='{$name}' onclick='currentSlide({$i})'></span>"; 
						}	
					?>
					</div>
			  </div> 
			</div> 
			<div class="row" style="min-height:230px">	
				<div class="col-lg-12">
					<ul id="gallery" class="text-left">
					<!-- Ajax update gallery slides here -->
					</ul>
				</div>
			</div>		
	  </div>
  </div>
</main> 

<script src="<?php echo $config->urls->templates?>photoswipe/lib/klass.min.js"></script>
<script src="<?php echo $config->urls->templates?>photoswipe/code.photoswipe-3.0.5.min.js"></script>   
<script src="<?php echo $config->urls->templates?>js/k4u-gallery-min.js"></script>

<script>
// webservice is the page being requested by ajax call 
var webservice = <?php echo "'{$config->urls->root}webservice/'"; ?>;
var rowCnt = 0; // table row count returned from Ajax response    
var sel = 'gallery'; // page id for ajax handler
var slideIndex = 1; // Start slide index
</script> 