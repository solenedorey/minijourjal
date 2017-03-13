<?php
namespace Sd\Framework\AppInterfaces;

interface DocumentInterface
{
    public static function creerDocumentVide();
    public static function creerDepuisTableau($data);
    public function modifierDepuisTableau($data);
}
