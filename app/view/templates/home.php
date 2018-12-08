<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Custom Behance Portfolio</title>
	<link rel="stylesheet" href="app/view/css/style.css">
	<link rel="stylesheet" href="app/view/css/foundation-icons.css">

	<!-- PhotoSwipe styles -->
	<link rel="stylesheet" href="app/view/css/photoswipe.css">
	<link rel="stylesheet" href="app/view/pswp_default_skin/default-skin.css">
</head>
<body>
	<header>
		 <div class="header-content">
		 	<img src="<?php echo $user['images']['100'] ?>" alt="Profile Image">

		 	<div class="user-info">
		 		<h2><?php echo $user['display_name'] ?></h2>
		 		<ul>
					<?php  
						foreach ($user['fields'] as $key) {
							echo '<li>'. $key .'</li>';
						}
					?>
		 		</ul>
		 		<p class="fi-marker"><?php echo $user['location'] ?></p>
		 	</div>
		 </div>
	</header>
	<main>
		<div class="projects_wrap">
			<?php 
				foreach ($projects as $project) {
					echo '
					<div class="project">
						<img class="project-cover" src="'. $project['covers']['404'] .'" alt="'. $project['name'] .'" data-project-id="'. $project['id'] .'">

						<div class="project_info">
							<!-- <h3>'. $project['name'] .'</h3> -->
							<a target="_blank" href="'. $project['url'] .'">'. $project['name'] .'</a>
							<ul>';

								foreach ($project['fields'] as $field) {
									echo '<li>'. $field .'</li>';
								}

						echo'</ul>
						</div>
					</div>';
				}
			?>
		</div>
	</main>
	<footer>
		<p>Powered By</p> <a target="_blank" href="<?php echo $user['url'] ?>"><i class="fi-social-behance"></i></a>
	</footer>

	<!-- PhotoSwipe main markup -->
	<div id="pswp" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

	    <!-- Background of PhotoSwipe. 
	         It's a separate element as animating opacity is faster than rgba(). -->
	    <div class="pswp__bg"></div>

	    <!-- Slides wrapper with overflow:hidden. -->
	    <div class="pswp__scroll-wrap">

	        <!-- Container that holds slides. 
	            PhotoSwipe keeps only 3 of them in the DOM to save memory.
	            Don't modify these 3 pswp__item elements, data is added later on. -->
	        <div class="pswp__container">
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	        </div>

	        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
	        <div class="pswp__ui pswp__ui--hidden">

	            <div class="pswp__top-bar">

	                <!--  Controls are self-explanatory. Order can be changed. -->

	                <div class="pswp__counter"></div>

	                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

	                <button class="pswp__button pswp__button--share" title="Share"></button>

	                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

	                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

	                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
	                <!-- element will get class pswp__preloader--active when preloader is running -->
	                <div class="pswp__preloader">
	                    <div class="pswp__preloader__icn">
	                      <div class="pswp__preloader__cut">
	                        <div class="pswp__preloader__donut"></div>
	                      </div>
	                    </div>
	                </div>
	            </div>

	            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
	                <div class="pswp__share-tooltip"></div> 
	            </div>

	            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
	            </button>

	            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
	            </button>

	            <div class="pswp__caption">
	                <div class="pswp__caption__center"></div>
	            </div>

	        </div>

	    </div>

	</div>

	<!-- PhotoSwipe Scripts -->
	<script src="app/view/js/photoswipe.js"></script>
	<script src="app/view/js/photoswipe-ui-default.js"></script>


	<script src="app/view/js/requests-handler.js"></script>
</body>
</html>