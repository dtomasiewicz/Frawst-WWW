<? if (count($feedback)): ?>
	<ul>
		<? foreach ($feedback as $message): ?>
			<li class="feedback feedback<?=$message['status']?>"><?=$message['message']?></li>
		<? endforeach; ?>
	</ul>
<? endif; ?>