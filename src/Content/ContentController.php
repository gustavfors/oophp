<?php

namespace Gufo\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;

    private $contentManager;

    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->contentManager = new ContentManager($this->app);
        $this->filter = new \Gufo\MyTextFilter\MyTextFilter();
    }
    
    public function indexAction()
    {
        $title = "overview";

        $res = $this->contentManager->getAll();

        $this->app->page->add("content/header");
        $this->app->page->add("content/index", [
            "resultset" => $res
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);

        return "Hello";
    }

    public function pageAction($show = "all")
    {
        $title = "pages";

        $path = htmlspecialchars($show);

        $this->app->page->add("content/header");

        if ($show == "all") {
            $res = $this->contentManager->getPages();
            $this->app->page->add("content/pages", [
                "resultset" => $res
            ]);
        } else {
            $res = $this->contentManager->getItemByPath($path);

            if (!$res) {
                $res = $this->contentManager->getItemBySlug($path);
            }
            
            $html = $this->filter->parse($res->data, $res->filter);

            $res->data = $html;

            if ($res->deleted) {
                $this->app->page->add("content/404");
            } else {
                $this->app->page->add("content/page", [
                "resultset" => $res
                ]);
            }
        } 

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function blogAction($show = "all")
    {
        $title = "blog";

        $slug = htmlspecialchars($show);

        $this->app->page->add("content/header");

        if ($show == "all") {
            $res = $this->contentManager->getPosts();
            $this->app->page->add("content/blog", [
                "resultset" => $res
            ]);
        } else {
            $res = $this->contentManager->getItemBySlug($slug);

            $html = $this->filter->parse($res->data, $res->filter);

            $res->data = $html;

            if ($res->deleted) {
                $this->app->page->add("content/404");
            } else {
                $this->app->page->add("content/blogpost", [
                    "resultset" => $res
                ]);
            }
        } 

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
    

    public function createAction()
    {
        if ($this->app->request->getPost('contentTitle') != null) {
            $res = $this->contentManager->create(htmlspecialchars($this->app->request->getPost('contentTitle')));

            return $this->app->response->redirect("content/update?id={$res}");
        } else {
            $title = "create";

            $this->app->page->add("content/header");

            $this->app->page->add("content/create");

            return $this->app->page->render([
                "title" => $title,
            ]);
        }
    }

    public function deleteActionGet()
    {
        $title = "create";

        if ($this->app->request->getGet('id') != null) {
            $id = htmlspecialchars($this->app->request->getGet('id'));

            $res = $this->contentManager->getItemById($id);

            $data = [
                "id" => $res->id,
                "title" => $res->title
            ];

            $this->app->page->add("content/header");
            $this->app->page->add("content/delete", $data);

            return $this->app->page->render([
                "title" => $title,
            ]);
        }
    }

    public function deleteActionPost()
    {
        $this->contentManager->delete(htmlspecialchars($this->app->request->getPost('contentId')));

        return $this->app->response->redirect("content");
    }

    public function updateActionGet()
    {
        $title = "update";

        if ($this->app->request->getGet('id') != null) {
            $id = htmlspecialchars($this->app->request->getGet('id'));

            $res = $this->contentManager->getItemById($id);
            
            $data = [
                "id" => $res->id,
                "title" => $res->title,
                "path" => $res->path,
                "slug" => $res->slug,
                "data" => $res->data,
                "type" => $res->type,
                "filter" => $res->filter,
                "published" => $res->published
            ];

            $this->app->page->add("content/header");
            $this->app->page->add("content/edit", $data);

            return $this->app->page->render([
                "title" => $title,
            ]);
        }
    }

    public function updateActionPost()
    {
        $this->contentManager->update(
            $this->app->request->getPost()
        );

        return $this->app->response->redirect("content");
    }

    public function adminActionGet()
    {
        $title = "admin";

        $res = $this->contentManager->getAll();

        $this->app->page->add("content/header");
        $this->app->page->add("content/admin", [
            "resultset" => $res
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
