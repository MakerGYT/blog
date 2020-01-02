<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer class="site-footer">
	<div class="inner">
<div class="offsite-links">
<?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true')->to($comments); ?>
<?php while($comments->next()): ?>
<a class="top_tooltip" href="<?php $comments->permalink(); ?>"><span><?php echo $comments->author; ?>：<?php $comments->excerpt(36, '...'); ?></span><?php $comments->gravatar('40',''); ?></a>
<?php endwhile; ?>
</div>
		<!-- .offsite-links -->
		<div class="site-info">
			&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a> all rights reserved.<br />
			Powered by <a target="_blank" href="http://typecho.org/" target="_blank">Typecho</a>.</a>
		</div><!-- .site-info -->
		<a href="#page" class="arrow-up" title="Back to Top"><span class="screen-reader-text">Back to the top</span></a>
	</div><!-- .inner -->
</footer><!-- .site-footer -->

	</div><!-- #page -->

	<script type="text/javascript" src="<?php $this->options->themeUrl(); ?>js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="<?php $this->options->themeUrl(); ?>js/plugins.js"></script>
	<script type="text/javascript" src="<?php $this->options->themeUrl(); ?>js/custom.js"></script>
	<?php $this->footer(); ?>
</body>
</html>