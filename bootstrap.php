<?php
	namespace Frawst;
	
	Loader::addClassPath(dirname(APP_ROOT).'/DataPane/libs/', 'DataPane');
	Loader::addClassPath(dirname(APP_ROOT).'/Corelativ/libs/', 'Corelativ');
	Loader::addClassPath(APP_ROOT.'libs/Model/', 'Corelativ\Model');
	
	if(($dpCfg = Config::read('DataPane')) && $dpCfg['enable']) {
		\DataPane\Data::init($dpCfg);
	}
	if(($coCfg = Config::read('Corelativ')) && $coCfg['enable']) {
		\Corelativ\Mapper::init($coCfg);
	}