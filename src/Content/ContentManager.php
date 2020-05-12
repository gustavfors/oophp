<?php

namespace Gufo\Content;

class ContentManager
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM content;";
        $this->app->db->connect();
        return $this->app->db->executeFetchAll($sql);
    }

    public function getPages()
    {
        $sql = <<<EOD
SELECT
    *,
    CASE 
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;
        $this->app->db->connect();
        return $this->app->db->executeFetchAll($sql, ["page"]);
    }

    public function getPosts()
    {
        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=? AND deleted IS NULL
ORDER BY created DESC
;
EOD;

        $this->app->db->connect();
        return $this->app->db->executeFetchAll($sql, ["post"]);
    }

    public function getItemById($id)
    {
        $sql = "SELECT * FROM content WHERE id=?";
        $this->app->db->connect();
        return $this->app->db->executeFetch($sql, [$id]);
    }

    public function getItemBySlug($slug)
    {
        $sql = "SELECT * FROM content WHERE slug=?";
        $this->app->db->connect();
        return $this->app->db->executeFetch($sql, [$slug]);
    }

    public function getItemByPath($path)
    {
        $sql = "SELECT * FROM content WHERE path=?";
        $this->app->db->connect();
        return $this->app->db->executeFetch($sql, [$path]);
    }

    public function create($title)
    {
        $sql = "INSERT INTO content (title) VALUES (?);";
        $this->app->db->connect();
        $this->app->db->execute($sql, [$title]);

        return $this->app->db->lastInsertId();
    }

    public function update($data)
    {
        $params = $data;

        if (!$params["contentSlug"]) {
            $params["contentSlug"] = $this->slugify($params["contentTitle"]);
        }

        $res = $this->getItemBySlug($params["contentSlug"]);

        if ($res) {
            $params["contentSlug"] = $params["contentSlug"] . $params['contentId'];
        }

        if (!$params["contentPath"]) {
            $params["contentPath"] = null;
        } else {
            $res = $this->getItemByPath($params["contentPath"]);
            if ($res) {
                $params["contentPath"] = $params["contentPath"] . $params['contentId'];
            }
        }

        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $this->app->db->connect();
        
        $this->app->db->execute($sql, [
            $params["contentTitle"],
            $params["contentPath"],
            $params["contentSlug"],
            $params["contentData"],
            $params["contentType"],
            $params["contentFilter"],
            $params["contentPublish"],
            $params["contentId"]
        ]);
    }

    public function delete($id)
    {
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $this->app->db->connect();
        $this->app->db->execute($sql, [$id]);
    }

    public function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(['å','ä'], 'a', $str);
        $str = str_replace('ö', 'o', $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }
}
