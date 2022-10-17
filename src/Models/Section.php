<?php
namespace src\Models;
class Section
{
    private int $id;
    private int $blogId;
    private string $title;
    private string $paragraph;
    private string|array $image;

    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }
    public function getBlogId()
    {
        return $this->blogId;
    }
    public function setBlogId($value)
    {
        $this->blogId = $value;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($value)
    {
        $this->title = $value;
    }
    public function getParagraph()
    {
        return $this->paragraph;
    }
    public function setParagraph($value)
    {
        $this->paragraph = $value;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($value)
    {
        $this->image = $value;
    }
}
