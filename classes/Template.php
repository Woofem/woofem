<?php

namespace Woofem;

class Template {

    /**
     * @var string
     *   Directory containing template files
     */
    private $template_directory;

    /**
     * @var string
     *   Directory containing partial template files
     */
    private $partials_directory;

    /**
     * Constructor
     * @param $config stdClass
     *   Application configuration object
     */
    public function __construct($config) {
        $this->template_directory = $config->template->template_directory;
        $this->partials_directory = $config->template->partials_directory;
    }

    /**
     * @param $file string
     *   Template name.
     * @param $data object
     *   Data to pass to template for rendering.
     * @return string
     *   Rendered HTML.
     */
    public function render($file, $data, $app) {
        require_once('../' . $this->template_directory . '/' . $file . '.html.php');
    }

}