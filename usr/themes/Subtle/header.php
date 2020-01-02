<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="<?php $this->options->charset(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php $this->archiveTitle(array(
'category'  =>  _t('分类 %s 下的文章'),
'search'    =>  _t('包含关键字 %s 的文章'),
'tag'       =>  _t('标签 %s 下的文章'),
'author'    =>  _t('%s 发布的文章')
), '', ' - '); ?><?php $this->options->title(); ?></title>
<link href="//fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic%7CPlayfair+Display:400,400italic,700,700italic" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php $this->options->themeUrl(); ?>style.css">
<!--[if lt IE 9]>
<script src="<?php $this->options->themeUrl(); ?>js/html5.js"></script>
<![endif]-->
<script src="<?php $this->options->themeUrl(); ?>js/sdk.min.js"></script>
<?php $this->header(); ?>
</head>

<?php if ($this->is('index')) : ?>
<body class="home-template">
<?php else: ?>
<body class="tag-template">
<?php endif; ?>

	<div id="page" class="site">

<header class="site-header">
	<h1 class="site-title"><a href="<?php $this->options->siteUrl(); ?>">#Blog-title.</a></h1>
	<a class="sidebar-toggle"><span class="screen-reader-text">Menu and Widgets</span><span class="icon" aria-hidden="true"></span></a>
</header><!-- .site-header -->

<main class="site-main">
	<div class="site-content">