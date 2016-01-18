<?php

require_once __DIR__ . '/models/news.php';

$items = News::getAll();
//?><!--<pre>--><?php //print_r($news); ?><!--</pre>--><?php

include __DIR__ . '/views/index.php';
