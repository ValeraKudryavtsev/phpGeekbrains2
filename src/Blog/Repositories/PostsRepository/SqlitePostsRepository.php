<?php

namespace GeekBrains\LevelTwo\Blog\Repositories\PostsRepository;

use Exception;
use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\UUID;

class SqlitePostsRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Post $post): void {
        // Подготавливаем запрос
        $statement = $this->connection->prepare(
            'INSERT INTO posts (author, title, uuid, text) VALUES (:author, :title, :uuid, :text)'
        );
        // Выполняем запрос с конкретными значениями
        $statement->execute([
            ':author' => $post->getAuthor()->username(),
            ':title' => $post->getTitle(),
            ':uuid' => (string)$post->uuid(),
            ':text' => $post->getText(),
        ]);
    }

    /**
     * @throws Exception
     */
    public function get(UUID $uuid): Post {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = ?'
        );

        $statement->execute([(string)$uuid]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Бросаем исключение, если пользователь не найден
        if ($result === false) {
            throw new Exception(
                "Cannot get post: $uuid"
            );
        }
        return $this->getPost($statement, $uuid);
    }

    /**
     * @throws Exception
     */
    private function getPost(PDOStatement $statement, string $errorString): Post
    {
        $usersRepository = new SqliteUsersRepository($this->connection);

        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new Exception(
                "Cannot find post: $errorString"
            );
        }

        // Создаём объект пользователя с полем username
        return new Post(
            new UUID($result['uuid']),
            $usersRepository->getByUsername($result['author']),
            $result['title'],
            $result['text'],
        );
    }
}