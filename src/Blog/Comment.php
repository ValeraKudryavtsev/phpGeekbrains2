<?php

namespace GeekBrains\LevelTwo\Blog;

use GeekBrains\LevelTwo\Person\Person;

class Comment
{
    private int $id;
    private Person $author;
    private Post $post;
    private string $text;

    /**
     * @param int $id
     * @param Person $author
     * @param Post $post
     * @param string $text
     */
    public function __construct(int $id, Person $author, Post $post, string $text)
    {
        $this->id = $id;
        $this->author = $author;
        $this->post = $post;
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->author . ' пишет комментарий: ' . $this->text . PHP_EOL . 'Под постом "' . $this->post->getTitle() . '"' . PHP_EOL;
    }

}