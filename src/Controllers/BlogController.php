<?php

namespace src\Controllers;

use src\Models\Blog;
use PDO;
use src\Utilities\Database;

class BlogController
{
    public static function getAllBlogs()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query('SELECT * FROM posts');
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $toReturn = [];
        foreach ($result as $row) {
            $blog = new Blog();
            $blog->setId($row->id);
            $blog->setTitle($row->title);
            $blog->setHeadline($row->headline);
            $blog->setImage($row->image);
            $blog->setCreatedAt($row->created_at);
            $blog->setUpdatedAt($row->updated_at);
            array_push($toReturn, $blog);
        }
        return $toReturn;
    }
    public static function validateBlog(Blog $blog)
    {
        if (strlen($blog->getTitle()) > 255) {
            return false;
        }
        if (strlen($blog->getHeadline()) > 255) {
            return false;
        }
        if ($blog->getImage()['error'] === 4) {
            return false;
        }
        if (!$blog->getTitle() || !$blog->getHeadline()) {
            return false;
        }
        return true;
    }
    public static function createBlog(Blog $blog)
    {
        $pdo = Database::connect();

        //Saving the image
        $image = $blog->getImage();
        $tmp = explode('/', $image['type']);
        $name = rand(0, 2465472462) . time() . '.' . end($tmp);
        move_uploaded_file($image['tmp_name'], 'assets/blog-images/' . $name);

        //Saving into the db
        $stmt = $pdo->prepare('INSERT INTO posts (title,headline,image) values (?,?,?)');
        $stmt->execute([$blog->getTitle(), $blog->getHeadline(), $name]);

        $pdo = NULL;
    }
    public static function getBlogInfo($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare('SELECT * FROM posts WHERE id=?');
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        $blog = new Blog();
        $blog->setTitle($res[0]->title);
        $blog->setHeadline($res[0]->headline);
        $blog->setImage($res[0]->image);
        $blog->setCreatedAt($res[0]->created_at);
        $blog->setUpdatedAt($res[0]->updated_at);
        return $blog;
    }
    public static function blogExists($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare('SELECT * FROM posts WHERE id=?');
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;
        if(count($res)){
            return true;
        }
        return false;
    }
    public static function deleteBlog($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare('DELETE FROM posts WHERE id=?');
        $stmt->execute([$id]);
        $pdo = null;
    }
}
