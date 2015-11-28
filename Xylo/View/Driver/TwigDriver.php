<?php
namespace Xylo\View\Driver;

use Xylo\Conf\Conf;

class TwigDriver implements ViewDriver
{
    private $twig;

    public function __construct()
    {
        $env = Conf::getConf('global.env');
        $loader = new \Twig_Loader_Filesystem(ROOT_PATH . 'App/Views');

        $params = array();
        if ($env === 'dev') {
            array(
                'cache' => ROOT_PATH . 'cache/',
                'debug' => true
            );
        }
        $this->twig = new \Twig_Environment($loader, $params);
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->addTwigFunction();

    }

    /**
     * Display template
     *
     * @param $template
     * @param array $params
     */
    public function displayResponse($template, array $params)
    {
        if ($params === null) {
            $params = (array) $params;
        }

        echo $this->twig->render($template . '.html.twig', $params);
    }

    /**
     * Return Personal twig function
     *
     * @return array
     */
    private function getTwigFunction()
    {
        $functions[] = new \Twig_SimpleFunction('component', function ($componentPath) {
            return "/../components/$componentPath";
        });

        return $functions;
    }

    /**
     * Add personal twig function
     */
    private function addTwigFunction()
    {
        foreach ($this->getTwigFunction() as $function) {
            $this->twig->addFunction($function);
        }
    }
}
