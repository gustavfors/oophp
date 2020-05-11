<?php

namespace Gufo\MyTextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class MyTextFilterController implements AppInjectableInterface
{
    use AppInjectableTrait;
    
    public function indexAction()
    {

        $page = $this->app->request->getGet('filter') ?? "bbcode";

        $title = $page;
        
        $filter = new MyTextFilter();

        if ($page != "markdown") {
            $text = file_get_contents(__DIR__ . "/../../text/{$page}.txt");
        } else {
            $text = file_get_contents(__DIR__ . "/../../text/{$page}.md");
        }
        
        $html = $filter->parse($text, "{$page}");

        $this->app->page->add("mytextfilter/header");
        $this->app->page->add("mytextfilter/{$page}", [
            "text" => $text,
            "html" => $html
        ]);
        
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
