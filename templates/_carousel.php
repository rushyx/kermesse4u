
<!-- Bootstrap Carousel slide show markup -->
 <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" style="max-height:832px;"> 
      <?php 
      $i=0;
      foreach ($homepage->sliders as $slide) {
      	if (!$i++) {
      		echo "<div class='item active'>"; }
      	else {
      		echo "<div class='item'>"; }
      		 
      	echo "<img src= '{$slide->url}' alt='{$slide->description}' title='{$slide->description}' style='width:100%'>";
       	//echo "<div class='parallax slide$i'></div>";
       	// swap above lines for a parallax carousel and enable code in _init.php 
      	echo "</div>";
      }
      
      if ($i==0) {
			echo "<p>Placeholder for your slides</p>";
      }
      ?>
    </div>

    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php 
    for($x=0; $x<=$i-1; ++$x) {
    	$act= (!$x) ? "class='active'":"";
	 	echo "<li data-target='#myCarousel' data-slide-to='$x' $act ></li>";
    }
    ?>
    </ol>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>