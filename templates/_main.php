<?php namespace ProcessWire;
/**
 * _main.php
 * This file is automatically appended to all template files as a result of 
 * $config->appendTemplateFile = '_main.php'; in /site/config.php. 
 *
 * In any given template file, if you do not want this main markup file 
 * included, go in your admin to Setup > Templates > [some-template] > and 
 * click on the "Files" tab. Check the box to "Disable automatic append of
 * file _main.php". 
 *
 * Output common footer, closing </body> & </html>
 */

?>

<footer class="container-fluid text-center">
	
	<img class='img-responsive' src= <?php echo "'$strapln->url' alt= '$strapln->description' title= '$strapln->description'"?>>  	

  	<p>
	<a href= "https://www.facebook.com/pages/Kermesse-Wedding-Planning/278474058856866"><img src= "https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook.png" alt= "Facebook icon" title="Facebook"></a>
	<a href= "http://www.flickr.com/photos/98667052@N05/"><img src= "https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-flickr.png" alt= "Flickr" title="Flickr"></a>	
  	</p> 	

	<p>
	<a href= "https://www.matrimonio.com/wedding-planner/kermesse--e14850" title= "Kermesse, vincitore Wedding Awards 2014 matrimonio.com"><img width= "70" height= "70" alt= "Kermesse, vincitore Wedding Awards 2014 matrimonio.com" src="https://cdn1.matrimonio.com/img/badges/2014/badge-weddingawards_it_IT.jpg"/></a>
	<a href= "https://www.matrimonio.com/wedding-planner/kermesse--e14850" title= "Kermesse, vincitore Wedding Awards 2015 matrimonio.com"><img width= "70" height= "70" alt= "Kermesse, vincitore Wedding Awards 2015 matrimonio.com" src="https://cdn1.matrimonio.com/img/badges/2015/badge-weddingawards_it_IT.jpg"/></a>
	<a href= "https://www.matrimonio.com/wedding-planner/kermesse--e14850" title= "Kermesse, vincitore Wedding Awards 2016 matrimonio.com"><img width= "70" height= "70" alt= "Kermesse, vincitore Wedding Awards 2016 matrimonio.com" src="https://cdn1.matrimonio.com/img/badges/2016/badge-weddingawards_it_IT.jpg"/></a>
	<a href= "https://www.matrimonio.com/wedding-planner/kermesse--e14850" title= "Kermesse, vincitore Wedding Awards 2017 matrimonio.com"><img width= "70" height= "70" alt= "Kermesse, vincitore Wedding Awards 2017 matrimonio.com" src="https://cdn1.matrimonio.com/img/badges/2017/badge-weddingawards_it_IT.jpg"/></a>
	<a href= "https://www.matrimonio.com/wedding-planner/kermesse--e14850" title= "Kermesse, vincitore Wedding Awards 2018 matrimonio.com"><img width= "70" height= "70" alt= "Kermesse, vincitore Wedding Awards 2018 matrimonio.com" src="https://cdn1.matrimonio.com/img/badges/2018/badge-weddingawards_it_IT.jpg"/></a>	
	</p>

	<?php 
  	 echo $foot;
  	 ?>
  	<p>
  	<?php
	if($user->isLoggedin()) {
		// if user is logged in, show a logout link
		echo "<a href='{$config->urls->admin}login/logout/'><span class='glyphicon glyphicon-log-out'></span> " . sprintf(__('Logout (%s)'), $user->name) . "</a>";
	} else {
		// if user not logged in, show a login link
		echo "<a href='{$config->urls->admin}'><span class='glyphicon glyphicon-log-in'></span> " . __('Admin Login') . "</a>";
	}
	?>
	</p>

</footer>

</body>
</html>
