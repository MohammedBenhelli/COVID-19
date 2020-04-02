<?php

$test = file_get_contents("test");

$regex = [
    "/{{(.*?)}}/" => "<?= htmlentities($1) ?>",
    "/@if((?:\ \()(?:.*)(?:\)))/" => "<?php if$1: ?>",
    "/@elseif((?:\ \()(?:.*)(?:\)))/" => "<?php elseif$1: ?>",
    "/@else/" => "<?php else: ?>",
    "/@endif/" => "<?php endif; ?>",
    "/@foreach((?:\ \()(?:.*)(?:\)))/" => "<?php foreach$1: ?>",
    "/@endforeach/" => "<?php endforeach; ?>",
    "/@isset((?:\ \()(?:.*)(?:\)))/" => "<?php if (isset$1): ?>",
    "/@endisset/" => "<?php endif; ?>",
    "/@empty((?:\ \()(?:.*)(?:\)))/" => "<?php if (empty$1): ?>",
    "/@endempty/" => "<?php endif; ?>"
];

foreach ($regex as $pattern => $replace)
    $test = preg_replace($pattern, $replace, $test);

echo $test;