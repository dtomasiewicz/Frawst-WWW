<?
	$this->Response->contentType('text/html');
	$this->Html->addJs('jquery');
	$this->Html->addJs('jquery-config');
	
	$sidebar = null;
	$pageClass = 'oneCol';
	if($this->exists('sidebar')) {
		$sidebar = $this->get('sidebar');
		$pageClass = 'twoCol';
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en-ca">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title><?=isset($title) ? $title.' - ' : ''?>Frawst Framework</title>
	<link rel="icon" type="image/x-icon" href="<?=$this->webroot('public/images/favicon.ico')?>">
	
	<link rel="stylesheet" href="<?=$this->webroot('public/css/core.css')?>">
	<? foreach ($this->Html->css() as $file): ?>
		<link rel="stylesheet" href="<?=$this->webroot('public/css/'.$file.'.css')?>">
	<? endforeach; ?>
	
	<script type="text/javascript">
		const ROOT = "<?=$this->webroot()?>";
		const ROUTE = "<?=$this->Request->Route->resolved()?>";
	</script>
	
	<? foreach ($this->Html->js() as $file): ?>
		<script type="text/javascript" src="<?=$this->webroot('public/js/'.$file.'.js')?>"></script>
	<? endforeach; ?>
</head>
<body>

<div id="wrapper">
	<div id="header">
		<h1>Frawst Framework</h1>
		<ul id="nav">
			<li><?=$this->Html->appLink('', 'Home')?></li>
			<li><?=$this->Html->link('http://github.com/dtomasiewicz/Frawst', 'Code')?></li>
			<li><?=$this->Html->link('http://redmine.frawst.com/projects/frawst', 'Issues')?></li>
			<li><?=$this->Html->appLink('documentation', 'Documentation')?></li>
			<li><?=$this->Html->appLink('about', 'About')?></li>
		</ul>
	</div>
	
	<div id="feedback"><?=$this->ajax('feedback')?></div>
	
	<div id="page" class="<?=$pageClass?>">
		<div id="content" class="contentArea">
			<?=$content?>
		</div>
		<? if($sidebar): ?>
		<div id="sidebar" class="sidebar-<?=$sidebar?>"><?=$this->partial('sidebar/'.$sidebar)?></div>
		<? endif; ?>
	</div>
	
	<div id="footer">Copyright &copy; 2011 Daniel Tomasiewicz</div>
</div>

</body>
</html>
