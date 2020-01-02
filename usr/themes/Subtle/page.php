<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<header class="cover page-header">
			<div class="cover-content">
				<div class="inner">
					<div class="post-count">This is a page</div>
					<h1 class="page-title"><?php $this->title() ?></h1>
				</div><!-- .inner -->
			</div><!-- .cover-content -->
</header><!-- .cover -->

<div class="post inner">
<article class="post">
		
		<div class="inner">
		<div class="post-content">
		<?php $this->content(); ?>
		</div><!-- .post-content -->
		<footer class="post-footer share-post">
					<span>Share:</span>
					<a class="circle" target="_blank" href="https://twitter.com/intent/tweet?text=<?php $this->title() ?>&amp;url=<?php $this->permalink() ?>"><i class="icon-twitter" aria-hidden="true"></i><span class="screen-reader-text">Twitter</span></a>
					<a class="circle" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php $this->permalink() ?>"><i class="icon-facebook" aria-hidden="true"></i><span class="screen-reader-text">Facebook</span></a>
					<a class="circle" target="_blank" href="http://plus.google.com/share?url=<?php $this->permalink() ?>"><i class="icon-google" aria-hidden="true"></i><span class="screen-reader-text">Google+</span></a>
		</footer><!-- .post-footer -->
		</div><!-- .inner -->
		
<section class="comments-area" style="background: rgba(245, 245, 245, 0.29);padding: 15px 30px;margin-bottom: 20px;">
<?php $this->need('comments.php'); ?>
</section><!-- .comments-area -->	

</article>


</div><!-- .post-list -->

	
	</div><!-- .site-content -->
</main><!-- .site-main -->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>