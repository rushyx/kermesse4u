<?php 

if($config->ajax) 
{
	$selector = $sanitizer->text($input->post('selector'));
	$selector = strtolower($selector);
	
	$gno = $sanitizer->int($input->post('gno'));
	$fbOnPg = $sanitizer->int($input->post('fbpp'));

	$rowCnt = -1; // init. 
	$content = ''; // holds the markup
	$image = ''; // only used in home response
	
	if ($selector == 'gallery'){
		// gno is 1 based 
		$pg = $pages->get('/gallery/');
		$gc = $pg->numChildren; // no. of albums 
	
		if ($gno > $gc) {
			$gno = $gc; // peg max value
		}  
	
		$children = $pg->children();
		// PW is 0 based
		$album = $children->eq($gno-1);
		$rowCnt = count($album->albumImages);

		foreach($album->albumImages as $image) 
		{
			$thumb = $image->size(100,100);
			$content .= "<li><a href='{$image->url}'><img src='{$thumb->url}' class='img-thumbnail' alt='{$thumb->description}' ></a></li>";
		}
	}
	elseif($selector == 'home') {
		// get the feedback records
		$fbpage = $pages->get('/feedback/');
		$feedbacks = $fbpage->children();
		$rowCnt = $fbpage->numChildren;
		// if there is some feedback, grab one at random for display
		if ($rowCnt) {
			$fb = $feedbacks->getRandom();
			$content = $fb->testimonial;
			// if there is an image use it else use the stock img on fb page
			if (count($fb->images)) {
		   	$img = $fb->images->first;
		   }
		   else {
		   	$img = $fbpage->couple_anon;
		   }
		}
		else {
			$content = '<p>No feedback currently available</p>';
			$img = $fbpage->couple_anon;
		}
	   
	   $img = $img->size(110,145);
	 	$image = "<img class='fb-panel img-circle img-responsive' src='$img->url' alt='$img->description' title='$img->description'>";	   			 					   			 	
	}
	elseif($selector == "feedback") { 
		//$fbOnPg = 4; // spec. how many fbs on a page
		// get the feedback records
		$fbpage = $pages->get('/feedback/');
		$feedbacks = $fbpage->children();
		$nc = $fbpage->numChildren;
		$x = ($gno + $fbOnPg > $nc) ? $nc : $gno + $fbOnPg;
		$rowCnt = ($gno + $fbOnPg > $nc) ? $nc - $gno : $fbOnPg; 
		
		for($i = $gno; $i < $x; ++$i) {
			$fb = $feedbacks->eq($i);
			$test = ($fb->testimonial) ? $fb->testimonial: "<p>$fb->title feedback is empty</p>";
			$content .= "<li>$test</li>";						
		}				
	
		if($content) {
			$content = "<ul>$content</ul>";
		} 
	}
	else {	
		$content = "<p>Unexpected selector: $selector </p>";
		$rowCnt = 1; 
	}
	
	// if no markup return a generic empty markup
	if (!$content) $content = '<p>No records found</p>';

	$response = array(
	    'noRows' => $rowCnt,
	    'rowData' => $content,
	    'imgLink' => $image
	);	

	
	$json = json_encode($response);
	
	echo $json;
	
}
?>
