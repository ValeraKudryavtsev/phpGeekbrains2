<?php

namespace GeekBrains\LevelTwo\Blog\Repositories\CommentsRepository;

use Exception;
use GeekBrains\LevelTwo\Blog\Comment;
use GeekBrains\LevelTwo\Blog\Exceptions\InvalidArgumentException;
use GeekBrains\LevelTwo\Blog\Exceptions\UserNotFoundException;
use GeekBrains\LevelTwo\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use GeekBrains\LevelTwo\Blog\UUID;

class SqliteCommentsRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Comment $comment): void {
        // Подготавливаем запрос
        $statement = $this->connection->prepare(
            'INSERT INTO comments (author, post, uuid, text) VALUES (:author, :post, :uuid, :text)'
        );
        // Выполняем запрос с конкретными значениями
        $statement->execute([
            ':author' => $comment->getAuthor()->username(),
            ':post' => (string)$comment->getPost()->getUuid(),
            ':uuid' => (string)$comment->uuid(),
            ':text' => $comment->getText(),
        ]);
    }
    /**
     * @throws Exception
     */
    public function get(UUID $uuid): Comment {
        $statement = $this->connection->prepare(
            'SELECT * FROM comments WHERE uuid = ?'
        );

        $statement->execute([(string)$uuid]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Бросаем исключение, если пользователь не найден
        if ($result === false) {
            throw new Exception(
                "Cannot get comment: $uuid"
            );
        }
        return $this->getComment($statement, $uuid);
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws UserNotFoundException
     */
    private function getComment(PDOStatement $statement, string $errorString): Comment
    {
        $usersRepository = new SqliteUsersRepository($this->connection);
        $postsRepository = new SqlitePostsRepository($this->connection);

        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new Exception(
                "Cannot find comment: $errorString"
            );
        }

        // Создаём объект пользователя с полем username
        return new Comment(
            new UUID($result['uuid']),
            $usersRepository->getByUsername($result['author']),
            $postsRepository->get($result['post']),
            $result['text'],
        );
    }
}