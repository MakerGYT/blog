<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<aside class="sidebar">
	<div class="sidebar-scrollable">
		<div class="inner">
			<div class="widget-area">

<nav class="site-navigation">
	<h2><?php $this->options->title(); ?></h2>
	<ul class="menu">
	 <li class="menu-item home current-menu-item" role="presentation"><a href="<?php $this->options->siteUrl(); ?>">Home</a></li>
     <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
     <?php while($pages->next()): ?>
     <li class="menu-item about" role="presentation"><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
     <?php endwhile; ?>
	</ul><!-- .menu -->
</nav><!-- .site-navigation -->

			</div><!-- .widget-area -->
			<a class="sidebar-toggle"><span class="screen-reader-text">Close</span><span class="icon" aria-hidden="true"></span></a>
		</div><!-- .inner -->
	</div><!-- .sidebar-scrollable -->
</aside><!-- .sidebar -->