<?php
namespace Xylo\Plugins;

interface Plugin
{
    public function preCall();
    public function postCall();
}
