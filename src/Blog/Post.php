<?php

namespace GeekBrains\LevelTwo\Blog;

use GeekBrains\LevelTwo\Person\Person;

class Post
{
    private int $id;
    private Person $author;
    private string $title;
    private string $text;

    /**
     * @param int $id
     * @param Person $author
     * @param string $title
     * @param string $text
     */
    public function __construct(int $id, Person $author, string $title, string $text)
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->text = $text;
    }


    public function __toString()
    {
        return $this->author . ' пишет: ' . $this->text  . PHP_EOL;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}