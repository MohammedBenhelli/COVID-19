<?php

$test = file_get_contents("test");

$regexValue = "/{{(.*?)}}/";
$replaceValue = "<?= htmlentities($0) ?>";
$regexCondition = "/@if(?:\ \()(?:.*)(?:\))/";
$replaceCondition = "<?php if $0: ?>";
$regexCondition1 = "/@elseif(?:\ \()(?:.*)(?:\))/";
$replaceCondition1 = "<?php elseif $0: ?>";
$regexCondition2 = "/@else(?:\ \()(?:.*)(?:\))/";
$replaceCondition2 = "<?php else $0: ?>";

$test = preg_replace($regexValue, $replaceValue, $test);
$test = preg_filter($regexCondition, $replaceCondition, $test);
$test = preg_filter($regexCondition1, $replaceCondition1, $test);
echo preg_filter($regexCondition2, $replaceCondition2, $test);