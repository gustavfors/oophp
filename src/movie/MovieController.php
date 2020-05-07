<?php

namespace Gufo\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;
    
    public function indexAction()
    {
        $title = "view";

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

        $filter = "";

        $sql = "SELECT * FROM movie WHERE title LIKE ? OR year LIKE ?;";
        $this->app->db->connect();
        $res = $this->app->db->executeFetchAll($sql, [
            "%" . $filter . "%",
            "%" . $filter . "%"
        ]);

        var_dump($res);

        return "Sommartider!";
    }

    public function createAction()
    {

        $title = "create";

        $this->app->page->add("movie/create");
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editAction()
    {

        $title = "edit";

        $id = (int)htmlspecialchars($this->app->request->getGet('id'));

        $sql = "SELECT * FROM movie WHERE id=?";

        $this->app->db->connect();
        $res = $this->app->db->executeFetchAll($sql, [$id]);

        $this->app->page->add("movie/edit", [
            "res" => $res
        ]);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function processAction()
    {
        //Add new movie
        if ($this->app->request->getPost('create') != null) {
            $title = htmlspecialchars($this->app->request->getPost('title'));
            $year = (INT)htmlspecialchars($this->app->request->getPost('year'));
            $image = htmlspecialchars($this->app->request->getPost('image'));

            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $this->app->db->connect();
            $res = $this->app->db->execute($sql, [
                $title,
                $year,
                $image
            ]);

            return $this->app->response->redirect("movie/");
        }

        //Update existing movie
        if ($this->app->request->getPost('edit') != null) {
            $id = htmlspecialchars($this->app->request->getPost('id'));
            $title = htmlspecialchars($this->app->request->getPost('title'));
            $year = (INT)htmlspecialchars($this->app->request->getPost('year'));
            $image = htmlspecialchars($this->app->request->getPost('image'));

            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $this->app->db->connect();
            $res = $this->app->db->execute($sql, [
                $title,
                $year,
                $image,
                $id
            ]);

            return $this->app->response->redirect("movie/");
        }

        //Delete existing movie
        if ($this->app->request->getGet('delete') != null) {

            $id = htmlspecialchars($this->app->request->getGet('delete'));

            $sql = "DELETE FROM movie WHERE id = ?";
            $this->app->db->connect();
            $res = $this->app->db->execute($sql, [$id]);

            return $this->app->response->redirect("movie/");
        }

    }

}
