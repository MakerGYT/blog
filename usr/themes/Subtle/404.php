<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<header class="cover page-header">
			<div class="cover-content">
				<div class="inner">
					<div class="post-count">This is a page</div>
					<h1 class="page-title">404 - <?php _e('页面没找到'); ?></h1>
				</div><!-- .inner -->
			</div><!-- .cover-content -->
</header><!-- .cover -->
<div class="post inner">
<article class="post">
		<div class="inner">
		<div class="post-content">
		            <p><?php _e('你想查看的页面已被转移或删除了, 要不要搜索看看: '); ?></p>
            <form method="post">
                <p><input type="text" name="s" class="text" autofocus /></p>
                <p><button type="submit" class="submit"><?php _e('搜索'); ?></button></p>
            </form>
		</div><!-- .post-content -->
		</div><!-- .inner -->
</article>
</div><!-- .post-list -->
	</div><!-- .site-content -->
</main><!-- .site-main -->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>