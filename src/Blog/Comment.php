<?php

namespace GeekBrains\LevelTwo\Blog;

class Comment
{
    private UUID $uuid;
    private User $author;
    private Post $post;
    private string $text;

    /**
     * @param \GeekBrains\LevelTwo\Blog\UUID $uuid
     * @param User $author
     * @param Post $post
     * @param string $text
     */
    public function __construct(\GeekBrains\LevelTwo\Blog\UUID $uuid, User $author, Post $post, string $text)
    {
        $this->uuid = $uuid;
        $this->author = $author;
        $this->post = $post;
        $this->text = $text;
    }

    /**
     * @return \GeekBrains\LevelTwo\Blog\UUID
     */
    public function getUuid(): \GeekBrains\LevelTwo\Blog\UUID
    {
        return $this->uuid;
    }

    /**
     * @param \GeekBrains\LevelTwo\Blog\UUID $uuid
     */
    public function setUuid(\GeekBrains\LevelTwo\Blog\UUID $uuid): void
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
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post): void
    {
        $this->post = $post;
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
        return $this->author . ' пишет комментарий: ' . $this->text . PHP_EOL . 'Под постом "' . $this->post->getTitle() . '"' . PHP_EOL;
    }

}