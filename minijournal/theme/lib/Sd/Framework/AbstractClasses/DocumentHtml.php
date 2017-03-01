<?php
namespace Sd\Framework\AbstractClasses;

abstract class DocumentHtml
{
    protected function getHtmlContent($filePath)
    {
        ob_start();
        include($filePath);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
