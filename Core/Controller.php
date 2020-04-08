<?php


namespace Core;

class Controller
{
    private static array $regex = [
        "/{{(.*?)}}/" => "<?= htmlentities($1) ?>",
        "/@if((?:\ \()(?:.*)(?:\)))/" => "<?php if$1: ?>",
        "/@elseif((?:\ \()(?:.*)(?:\)))/" => "<?php elseif$1: ?>",
        "/@else/" => "<?php else$1: ?>",
        "/@endif/" => "<?php endif; ?>",
        "/@foreach((?:\ \()(?:.*)(?:\)))/" => "<?php foreach$1: ?>",
        "/@endforeach/" => "<?php endforeach; ?>",
        "/@isset((?:\ \()(?:.*)(?:\)))/" => "<?php if (isset$1): ?>",
        "/@endisset/" => "<?php endif; ?>",
        "/@empty((?:\ \()(?:.*)(?:\)))/" => "<?php if (empty$1): ?>",
        "/@endempty/" => "<?php endif; ?>"
    ];
    private static string $_render;

    protected function render($view, $scope = [], bool $templateEngine = false)
    {
        extract($scope);
        $f = $_SERVER["DOCUMENT_ROOT"] . "/MVC_PiePHP/src/View/" . $view . ".blade.php";

        if (file_exists($f)) {
            ob_start();
            if (!$templateEngine) {
                include $_SERVER["DOCUMENT_ROOT"] . "/MVC_PiePHP/src/View/" . $view . ".blade.php";
                $view = ob_get_clean();
                ob_start();
                include $_SERVER["DOCUMENT_ROOT"] . "/MVC_PiePHP/src/View/index.php";
                self::$_render = ob_get_clean();
                echo self::$_render;
            } else {
                $template = file_get_contents($f);
                foreach (self::$regex as $pattern => $replace)
                    $template = preg_replace($pattern, $replace, $template);
                file_put_contents("tmpTemplate", $template);
                include "tmpTemplate";
                self::$_render = ob_get_clean();
                echo self::$_render;
                unlink("tmpTemplate");
            }
        }
    }
}