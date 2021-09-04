<?php

	// set php runtime to unlimited
	set_time_limit(0);

	$last=filemtime("deliveryStatus.txt");

	$file=fopen("deliveryStatus.txt","r");
	while(true){
		clearstatcache();
		$new=filemtime("deliveryStatus.txt");
		if($new>$last){
			echo fread($file, filesize("deliveryStatus.txt"));
			break;
		}
		else{
			sleep(2);
			continue;
		}
		
	}
?>