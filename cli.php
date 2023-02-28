<?php

use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Person\Name;
use GeekBrains\LevelTwo\Person\Person;
use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\Repositories\InMemoryUsersRepository;
use \GeekBrains\LevelTwo\Blog\Comment;

//spl_autoload_register('load');

include __DIR__ . "/vendor/autoload.php";

function load($className)
{
//приходит GeekBrains\Person\Name
//нужно src/Person/Name.php

    $file = $className . ".php"; // Person/Name.php
    $file = str_replace("\\", "/", $file);
//    -------- Решение задания 1 --------
    $count = 1;
    $file = str_replace("GeekBrains", "src", $file, $count);
//    -----------------------------------
    if (file_exists($file)) {
        include $file;
    }
}

$faker = Faker\Factory::create('ru_RU');

$userRepository = new InMemoryUsersRepository();
$name = new Name($faker->firstName(), $faker->lastName());
$person = new Person($name, new DateTimeImmutable());
// с id и логином пока что так
$user = new User(1, $name, $person);
$userRepository->save($user);

if (count($argv) > 1 && $argv[1] == 'user') {
    $name = new Name($faker->firstName(), $faker->lastName());
    $person = new Person($name, new DateTimeImmutable());
    $user = new User(rand(2, 100), $name, $person);
    $userRepository->save($user);
    echo $user;
} elseif (count($argv) > 1 && $argv[1] == 'post') {
    $name = new Name($faker->firstName(), $faker->lastName());
    $person = new Person($name, new DateTimeImmutable());
    $post = new Post(1, $person, $faker->realText(rand(10, 20)), $faker->realText(rand(100, 200)));
    echo $post;
} elseif (count($argv) > 1 && $argv[1] == 'comment') {
    $name = new Name($faker->firstName(), $faker->lastName());
    $person = new Person($name, new DateTimeImmutable());
    $post = new Post(1, $person, $faker->realText(rand(10, 20)), $faker->realText(rand(100, 200)));
    $comment = new Comment(
        1,
        $person,
        $post,
        $faker->realText(rand(10, 20)));
    echo $comment;
} else {
    echo "Дополните команду\n";
}