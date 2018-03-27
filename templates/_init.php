<?php namespace ProcessWire;

/**
 * Initialize variables 
 * Provide markup for common <head> section, hreflang' link tags, opening <body>, 
 * output site logo, nav menu <nav> with language switch links
 *  
 * This file is automatically prepended to all template files as a result of:
 * $config->prependTemplateFile = '_init.php'; in /site/config.php. 
 *
 * If you want to disable this automatic inclusion for any given template, 
 * go in your admin to Setup > Templates > [some-template] and click on the 
 * "Files" tab. Check the box to "Disable automatic prepend file". 
 *
 */
// We refer to our homepage a few times in our site, so 
// we preload a copy here in $homepage for convenience. 
$homepage = $pages->get('/'); 
// likewise the site settings page.  
$ssetpage = $pages->get('/site-settings/');
// The site wide not found image/strapline/version no.
$noJSavail = $ssetpage->nonJSmsg;
$notfoundimg = $ssetpage->image_missing; 
$strapln = $ssetpage->strapline;
$version = $ssetpage->version;

// Likewise the site header & footer used throughout the site
$head = $ssetpage->header;
$foot = $ssetpage->footer;

$title = $page->get('headline|title'); 

// Include shared functions
include_once("./_func.php"); 

?>
<!DOCTYPE html>
<html lang="<?php echo _x('it', 'HTML language code'); ?>">
<head>
  <title><?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo $config->urls->templates?>css/bootstrap.min.css">
  <script src="<?php echo $config->urls->templates?>js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo $config->urls->templates?>js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?php echo $config->urls->templates?>css/main.css?=<?php echo $version ?>" > 
  <link rel="stylesheet" href="<?php echo $config->urls->templates?>photoswipe/photoswipe.css" > 
  <link rel="shortcut icon" href="<?php echo $config->urls->templates?>img/favicon.ico">
	
	<?php
	// handle output of 'hreflang' link tags for multi-language
	// this is good to do for SEO in helping search engines understand
	// what languages your site is presented in	
	
	foreach($languages as $language) {
		// if this page is not viewable in the language, skip it
		if(!$page->viewable($language)) continue;
		// get the http URL for this page in the given language
		$url = $page->localHttpUrl($language); 
	   // hreflang code for language uses language name from homepage
	   $hreflang = $homepage->getLanguageValue($language, 'name');
	   if ($language->isDefault())  $hreflang = 'it'; // default is Italian
		// output the <link> tag: note that this assumes your language names are the same as required by hreflang. 
		echo "\n\t<link rel='alternate' hreflang='$hreflang' href='$url' />";
	}
 
 // style for envelope icon on email links
 echo 
 	"<style>
	a[href^='mailto:'] {
	text-decoration: underline;
	background:url({$config->urls->templates}img/email.gif) no-repeat left center; 
	padding-left: 20px;
	}
 </style>";
 ?> 



<?php 
// code for a parallax carousel also see comment in _carousel.php
/* 
	echo
	"<style>
	.parallax { 
	// Set a specific height 
	height: 500px;
	// Create the parallax scrolling effect 
	background-attachment: fixed;
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
	} "; 
      
   $i=1;
   foreach ($homepage->sliders as $s) {
   	echo ".slide$i { background-image: url('{$s->url}');} ";
   	$i++;
   }

// Turn off parallax scrolling for all tablets and phones. Increase/decrease the pixels if needed
echo  
"@media only screen and (max-device-width: 1366px) {
    .parallax {
    	 background-attachment: scroll; 
    	 }
 } ";

   echo "</style>";
*/
?> 
</head>
<body>
		  	
<div class="container-fluid">
	<div class="row-fluid">
		<header>
			<?php 
				echo "<img class='img-responsive' src='$head->url' alt='$head->description' title='$head->description' >";
			 ?>
		</header>
	</div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href=<?php echo "'{$homepage->url}'>{$homepage->title}</a>"; ?>   
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">

      <?php echo renderNavTree($homepage->children, 0, "", "nav navbar-nav"); ?>

      <ul class="nav navbar-nav navbar-right">
			<?php // language switcher / navigation
			foreach($languages as $language) {
				if(!$page->viewable($language)) continue; // is page viewable in this language?
				if($language->id == $user->language->id) {
					$sel = "<span class='glyphicon glyphicon-ok'></span>";
					echo "<li class='current'>";
				} else {
					$sel = "";
					echo "<li>";
				}
				$url = $page->localUrl($language); 
				$hreflang = $homepage->getLanguageValue($language, 'name'); 
	   		if ($language->isDefault())  $hreflang = 'it'; // default is Italian				
				echo "<a hreflang='$hreflang' href='$url'>$sel $language->title</a></li>";
			}
			
			// output an "Edit" link if this page happens to be editable by the current user
			if($page->editable()) echo "<li class='edit'><a href='$page->editUrl'><span class='glyphicon glyphicon-edit'></span> " . __('Edit') . "</a></li>";

			?>
      </ul>
    </div>
  </div>
</nav>
