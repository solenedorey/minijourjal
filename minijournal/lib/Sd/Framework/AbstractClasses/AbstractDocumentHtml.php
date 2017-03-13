<?php
namespace Sd\Framework\AbstractClasses;

/**
 * Class AbstractDocumentHtml
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractDocumentHtml
{
    /**
     * @param $filePath
     * @return string
     */
    protected function getHtmlContent($filePath)
    {
        ob_start();
        include($filePath);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
