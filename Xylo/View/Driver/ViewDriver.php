<?php
namespace Xylo\View\Driver;

interface ViewDriver
{
    public function displayResponse($template, array $param);
}
