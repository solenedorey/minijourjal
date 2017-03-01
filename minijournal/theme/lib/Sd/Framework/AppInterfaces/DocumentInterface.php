<?php
namespace Sd\Framework\AppInterfaces;

interface DocumentInterface
{
    public static function creerArticleVide();

    public static function creerDepuisTableau($data);

    public function modifierDepuisTableau($data);

}