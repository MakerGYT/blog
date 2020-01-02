<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<header class="cover page-header">
			<div class="cover-content">
				<div class="inner">
					<div class="post-count">This is a page</div>
					<h1 class="page-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></h1>
				</div><!-- .inner -->
			</div><!-- .cover-content -->
</header><!-- .cover -->

<div class="post-list inner">
<?php if ($this->have()): ?>
<?php while($this->next()): ?>
<article class="post">
		<header class="post-header">
			<div class="tag-links">
				<?php $this->tags(', ', true, '<a href="javascript:;">None tags</a>'); ?>
			</div>
			<div class="post-header-wrap">
			<h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
				<div class="post-meta">
					<img class="author-avatar" src="<?php $this->options->themeUrl(); ?>images/about.jpg" alt="Loekman" /> <span class="post-author">by <a href="#">Loekman</a></span> <time class="published" datetime="<?php $this->date('c'); ?>"><?php $this->date('F j, Y'); ?></time>
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
  <?php else: ?>
            <article class="post">
                <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
            </article>
 <?php endif; ?>	
 
</div><!-- .post-list -->
 
	</div><!-- .site-content -->
</main><!-- .site-main -->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>