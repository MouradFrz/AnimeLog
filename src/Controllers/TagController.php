<?php

namespace src\Controllers;

use PDO;
use src\Utilities\Database;

class TagController
{
    public static function fetchTagsForBlog($blogid)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare('SELECT * FROM tags 
        INNER JOIN post_tag ON post_tag.tagid = tags.id
        WHERE postid = ?;');
        $stmt->execute([$blogid]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo = NULL;
        return $res;
    }
    public static function removeTagFromBlog($blogid, $tagid)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM post_tag WHERE postid=? AND tagid=?");
        $stmt->execute([$blogid, $tagid]);
        $pdo = NULL;
    }
    public static function findTags($keyword, $blogid)
    {
        $pdo = Database::connect();
        $pattern = '%' . $keyword . '%';

        $query = "SELECT * FROM tags
        WHERE name LIKE ? AND name NOT IN (SELECT name FROM tags 
        INNER JOIN post_tag ON post_tag.tagid = tags.id
        WHERE postid = ?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$pattern,$blogid]);
        $pdo = NULL;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public static function addTagToBlog($blogid, $tagid)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare('INSERT INTO post_tag values (?,?)');
        $stmt->execute([$blogid, $tagid]);
        $pdo = NULL;
    }
    public static function createAndAdd($blogid,$tagname){
        $pdo = Database::connect();
        $stmt = $pdo->prepare('INSERT INTO tags (name) values (?)');
        $stmt->execute([$tagname]);
        self::addTagToBlog($blogid,$pdo->lastInsertId());
        $pdo = NULL;
    }
}
