<?php

namespace GeekBrains\LevelTwo\Blog;

class Post
{
    private UUID $uuid;
    private User $author;
    private string $title;
    private string $text;

    /**
     * @param UUID $uuid;
     * @param User $author
     * @param string $title
     * @param string $text
     */
    public function __construct(UUID $uuid, User $author, string $title, string $text)
    {
        $this->uuid = $uuid;
        $this->author = $author;
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * @return UUID
     */
    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    /**
     * @param UUID $uuid
     */
    public function setUuid(UUID $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
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

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->author . ' пишет: ' . $this->text  . PHP_EOL;
    }
}