function changeImage()
{
	var div = divId + dInx; // cycle round 4 divs with url
	var caption = capId + dInx; // also replace the fig captions
	if (++dInx > divs) dInx = 1; 
	
  $(div).fadeOut('fast', function() 
  {
    $(this).attr('src', cmsImages[index]);
    $(this).attr('alt', imgDescript[index]);
 // $(this).attr('title', imgDescript[index]);    
    $(caption).text(imgDescript[index]);
    
    $(this).fadeIn('fast', function() 
    {
      if (index == 0)
      {
        index = noImgs - 1;
      }
      else
      {
        index--;
      }
    });
  });
} 

$(document).ready(function()
{
	noImgs = cmsImages.length;
	index = noImgs - 1; // start with last image and work back to first
	console.log("no. of images = ", noImgs, " Image change time (ms) = ", changeTm);

	// if there are more than 4 images and at least 1 div start a timer to animate the rest
	if (noImgs > 4 && divs > 0) {	
	  	console.log("[Kermesse] Events page has ", noImgs, " images & ", divs, " divs. Animation actioned");
  		setInterval (changeImage, changeTm);
  	}
  	else {
  		console.log("[Kermesse] Events page has ", noImgs, " images & ", divs, " divs. No animation actioned");
  	}
  	
});

