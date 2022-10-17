<?php

namespace src\Controllers;

use PDO;
use src\Models\Section;
use src\Utilities\Database;

class SectionController
{
    public static function createSection(Section $section, int $blogid)
    {
        $pdo = Database::connect();

        $image = $section->getImage();
        $tmp = explode('/', $image['type']);
        $name = rand(0, 2465472462) . time() . '.' . end($tmp);
        move_uploaded_file($image['tmp_name'], 'assets/section-images/' . $name);

        $stmt = $pdo->prepare("INSERT INTO sections (title,image,paragraph,blogid) values (?,?,?,?)");
        $stmt->execute([$section->getTitle(), $name, $section->getParagraph(), $blogid]);
        $pdo = NULL;
    }
    public static function loadSections($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM sections WHERE blogid = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        $toReturn = [];
        foreach ($res as $row) {
            $section = new Section();
            $section->setId($row->id);
            $section->setTitle($row->title);
            $section->setParagraph($row->paragraph);
            $section->setImage($row->image);
            $section->setBlogId($row->blogid);
            array_push($toReturn, $section);
        }
        $pdo = NULL;
        return $toReturn;
    }
    public static function sectionExists($sectionid){
        $pdo = Database::connect();
        $stmt = $pdo->prepare('SELECT * FROM sections WHERE id=?');
        $stmt->execute([$sectionid]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;
        if (count($res)) {
            return true;
        }
        return false;
    }
    public static function getSectionInfo($id){
        $pdo = Database::connect();
        $stmt = $pdo->prepare('SELECT * FROM sections WHERE id = ?');
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        $section = new Section();
        $section->setId($id);
        $section->setTitle($res[0]->title);
        $section->setParagraph($res[0]->paragraph);
        $section->setImage($res[0]->image);

        return $section;
    }
    public static function updateSection(Section $section){
        $pdo = Database::connect();

        if (file_exists('assets/section-images/' . self::getSectionInfo($section->getId())->getImage())) {
            unlink('assets/section-images/' . self::getSectionInfo($section->getId())->getImage());
        };

        $image = $section->getImage();
        $tmp = explode('/', $image['type']);
        $name = rand(0, 2465472462) . time() . '.' . end($tmp);
        move_uploaded_file($image['tmp_name'], 'assets/section-images/' . $name);

        $stmt = $pdo->prepare("UPDATE sections set title=?,image=?,paragraph=? where id=? ");
        $stmt->execute([$section->getTitle(), $name, $section->getParagraph(), $section->getId()]);
        $pdo = NULL;
    }
    public static function deleteSection($sectionid){
        if (file_exists('assets/section-images/' . self::getSectionInfo($sectionid)->getImage())) {
            unlink('assets/section-images/' . self::getSectionInfo($sectionid)->getImage());
        };
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM sections WHERE id = ?");
        $stmt->execute([$sectionid]);
        $pdo = NULL;
    }
}
