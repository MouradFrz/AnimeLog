<?php
namespace src\Models;
class Blog{
    private int $id;
    private string $title;
    private string $headline;
    private string|array $image;
    private string $created_at;
    private string $updated_at;
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function getHeadline(){
        return $this->headline;
    }
    public function setHeadline($headline){
        $this->headline = $headline;
    }
    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function getCreatedAt(){
        return $this->created_at;
    }
    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }
    public function getUpdatedAt(){
        return $this->updated_at;
    }
    public function setUpdatedAt($updated_at){
        $this->updated_at = $updated_at;
    }
}