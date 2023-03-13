<?php

use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Person\Name;
use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\InMemoryUsersRepository;
use \GeekBrains\LevelTwo\Blog\Comment;

include __DIR__ . "/vendor/autoload.php";

$faker = Faker\Factory::create('ru_RU');

$userRepository = new InMemoryUsersRepository();

$name = new Name($faker->firstName(), $faker->lastName());

$name = new Name(
    $faker->firstName('female'),
    $faker->lastName('female')
);
$user = new User(
    $faker->randomDigitNotNull(),
    $name,
    $faker->sentence(1)
);

$userRepository->save($user);

$route = $argv[1] ?? null;

switch ($route) {
    case "user":
        echo $user;
        break;

    case "post":
        $post = new Post(
            1,
            $user,
            $faker->text(100),
            $faker->realText(200, 1)
        );
        echo $post;
        break;

    case "comment":
        $post = new Post(
            1,
            $user,
            $faker->text(100),
            $faker->realText(200, 1)
        );
        $comment = new Comment(
            1,
            $user,
            $post,
            $faker->realText(100, 2)
        );
        echo $comment;
        break;

    default:
        echo 'Command error';
}
