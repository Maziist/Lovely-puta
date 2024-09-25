<?php
session_start();
//core
require_once '../core/Router.php';
require_once '../_db/Db.php';

//bundle quand ex src/controllers/commentcontrollers qui contient tout le touintouin
//repository
require_once '../src/repository/UserRepository.php';
require_once '../src/repository/PostRepository.php';
require_once '../src/repository/CommentRepository.php';
require_once '../src/repository/LikeResponsitory.php';

//controllers
require_once '../src/controllers/Controller.php';
require_once '../src/controllers/MainController.php';
require_once '../src/controllers/usercontrollers/LoginController.php';
require_once '../src/controllers/usercontrollers/RegisterController.php';
require_once '../src/controllers/usercontrollers/LogoutController.php';
require_once '../src/controllers/postcontrollers/AddPostController.php';
require_once '../src/controllers/postcontrollers/EditPostController.php';
require_once '../src/controllers/postcontrollers/DeletePostController.php';
require_once '../src/controllers/commentcontrollers/AddComment.php';
require_once '../src/controllers/commentcontrollers/EditComment.php';
require_once '../src/controllers/commentcontrollers/DeleteComment.php';
require_once '../src/controllers/likecontrollers/AddLike.php';
require_once '../src/controllers/likecontrollers/RemoveLike.php';

// models
require_once '../src/models/User.php';
require_once '../src/models/Post.php';
require_once '../src/models/Comment.php';




$router = new Router();
$router->start();