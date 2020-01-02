<?php
/**
 * SUBTLE Theme,来自loekman的移植作品。
 * 
 * @package SUBTLE
 * @author Loekman
 * @version 1.1
 * @link http://lu.ms/typecho-theme-subtle.html
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div class="cover hero">
			<div class="cover-bg" style="background-image: url(<?php $this->options->themeUrl(); ?>images/bg.jpg)"></div>
			<div class="cover-content">
				<div class="inner">
					<h2 class="hero-title">#Blog-title</h2>
					<p class="hero-text">#博客简介，修改成自己需要的内容。#</p>
					<a href="#" class="arrow-down"><span class="screen-reader-text">Scroll Down</span></a>
					<a href="<?php $this->options->siteUrl(); ?>feed/" title="您可以订阅本博客" class="subscribe button" target="_blank">Subscribe<span aria-hidden="true"><span class="line left"></span><span class="line top"></span><span class="line right"></span><span class="line bottom"></span></span></a>
				</div><!-- .inner -->
			</div><!-- .cover-content -->
</div><!-- .cover -->
 
<div class="post-list inner">
<?php while($this->next()): ?>
<article class="post">
		<header class="post-header">
			<div class="tag-links">
			<?php $this->tags(', ', true, '<a href="javascript:;">None tags</a>'); ?>
			</div>
			<div class="post-header-wrap">
			<h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
				<div class="post-meta">
					<img class="author-avatar" src="<?php $this->options->themeUrl(); ?>images/avatar.jpg" alt="<?php $this->author(); ?>" /> <span class="post-author">by <a href="#"><?php $this->author(); ?></a></span> <time class="published" datetime="<?php $this->date('c'); ?>"><?php $this->date('F j, Y'); ?></time>
				</div><!-- .post-meta -->
			</div><!-- .post-header-wrap -->
		</header><!-- .post-header -->
		<div class="post-content">
<?php $this->content(); ?>
<div class="read-more">
<a class="button" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">Read More<span aria-hidden="true"><span class="line left"></span><span class="line top"></span><span class="line right"></span><span class="line bottom"></span></span></a>
</div>
		</div><!-- .post-content -->
	</article>
<?php endwhile; ?>
</div><!-- .post-list -->

<nav class="pagination">
<h2 class="screen-reader-text">Posts Navigation</h2>
<?php $this->pageLink('Previous'); ?>
<span class="page-number"><?php if($this->_currentPage>0) echo 'Page '.$this->_currentPage.' of '; ?><?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?></span>
<?php $this->pageLink('Next','next'); ?>
</nav>
 
	</div><!-- .site-content -->
</main><!-- .site-main -->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>