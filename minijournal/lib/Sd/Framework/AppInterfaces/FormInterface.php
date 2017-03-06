<?php
namespace Sd\Framework\AppInterfaces;

interface FormInterface
{
    public static function nettoyer($form);
    public function estValide();
    public function getErreur($champ);
}
