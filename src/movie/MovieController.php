<?php

namespace Gufo\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;
    
    public function indexAction()
    {
        $title = "setup";

        $filter = htmlspecialchars($this->app->request->getGet('search')) ?? "";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE title LIKE ? OR year LIKE ?;";
        $res = $this->app->db->executeFetchAll($sql, [
            "%" . $filter . "%",
            "%" . $filter . "%"
        ]);

        $this->app->page->add("movie/index", [
            "resultset" => $res,
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function testAction()
    {

        $filter = "1999";

        $sql = "SELECT * FROM movie WHERE title LIKE ? OR year LIKE ?;";
        $this->app->db->connect();
        $res = $this->app->db->executeFetchAll($sql, [
            "%" . $filter . "%",
            "%" . $filter . "%"
        ]);

        var_dump($res);

        return "Sommartider!";
    }

}
