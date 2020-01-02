<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * 归档
 *
 * @package custom
 */
 $this->need('header.php'); ?>
 
 <header class="cover page-header">
			<div class="cover-content">
				<div class="inner">
					<div class="post-count">This is a page</div>
					<h1 class="page-title">文章归档</h1>
				</div><!-- .inner -->
			</div><!-- .cover-content -->
</header><!-- .cover -->
 
<div class="post inner">
<article class="post">
		
		<div class="inner">
		<div class="post-content">
			<p>
			<?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
    $year=0; $mon=0; $i=0; $j=0;
    $output = '<div id="archives">';
    while($archives->next()):
        $year_tmp = date('Y',$archives->created);
        $mon_tmp = date('m',$archives->created);
        $y=$year; $m=$mon;
        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
        if ($year != $year_tmp && $year > 0) $output .= '</ul>';
        if ($year != $year_tmp) {
            $year = $year_tmp;
            $output .= '<h3>'. $year .' 年</h3><ul>'; //输出年份
        }
        if ($mon != $mon_tmp) {
            $mon = $mon_tmp;
            $output .= '<li><span>'. $mon .' 月</span><ul>'; //输出月份
        }
        $output .= '<li>'.date('d日: ',$archives->created).'<a href="'.$archives->permalink .'">'. $archives->title .'</a></li>'; //输出文章日期和标题
    endwhile;
    $output .= '</ul></li></ul></div>';
    echo $output;
?>
			</p>
		</div><!-- .post-content -->

		</div><!-- .inner -->


</article>


</div><!-- .post-list -->

	
	</div><!-- .site-content -->
</main><!-- .site-main -->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>