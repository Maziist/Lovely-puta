<!DOCTYPE html>
<html lang="fr">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assests/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>LOVELY ROADMAP</title>
    </head>

    <body>
        <header>
            <h1>LOVELY PUTA</h1>
            <a href="/logout">Déconnexion</a>
        </header>
        <main>
            <section>
                <h2>Ajout de post</h2>
                <form action="/AddPost" method="post">
                    <label for="title">Title</label>
                    <input type="text" name="title" required>
                    <label for="content">Content</label>
                    <textarea name="content" id="content" required></textarea>
                    <button type="submit">Publier</button>
                </form>
            </section>
            <section>
                <h2>Posts</h2>
                <?php foreach ($posts as $post) : ?>
                    <article>
                        <?php if (isset($_POST['update']) && $_POST['update'] == $post->getId()) : ?>
                            <form action="/EditPost" method="post">
                                <input type="hidden" name="postId" value="<?= $post->getId() ?>">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="<?= htmlspecialchars($post->getTitle()) ?>" required>
                                <label for="content">Content</label>
                                <textarea name="content" id="content" required><?= htmlspecialchars($post->getContent()) ?></textarea>
                                <button type="submit">Valider</button>
                            </form>
                        <?php else : ?>
                            <h3><?= htmlspecialchars($post->getTitle()) ?></h3>
                            <p><?= htmlspecialchars($post->getContent()) ?></p>
                            <div class="post-actions">
                                <!-- Boutons J'aime/Je n'aime plus -->
                                <div class="like-buttons">
                                    <?php $likeCount = LikeRepository::getLikeCount($post->getId(), 'post'); ?>
                                    <?php if (LikeRepository::hasUserLiked($_SESSION['user_id'], $post->getId(), 'post')): ?>
                                        <form action="/RemoveLike" method="post">
                                            <input type="hidden" name="targetId" value="<?= $post->getId() ?>">
                                            <input type="hidden" name="type" value="post">
                                            <button type="submit"> (<?= $likeCount ?>)</button>
                                        </form>
                                    <?php else: ?>
                                        <form action="/AddLike" method="post">
                                            <input type="hidden" name="targetId" value="<?= $post->getId() ?>">
                                            <input type="hidden" name="type" value="post">
                                            <button type="submit"> (<?= $likeCount ?>)</button>
                                        </form>
                                    <?php endif; ?>
                                </div>

                                <?php if ($post->getUserID() == $_SESSION["user_id"]) : ?>
                                    <div class="post-actions">
                                        <form action="/DeletePost" method="post">
                                            <button type="submit" name="remove" value="<?= $post->getId() ?>" class="btn btn-delete" title="Supprimer">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <form action="" method="post">
                                            <button type="submit" name="update" value="<?= $post->getId() ?>" class="btn btn-edit" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>
                            </div>
                            <!-- Affichage des commentaires -->
                            <form action="/AddComment" method="post">
                                <input type="hidden" name="postId" value="<?= $post->getId() ?>">
                                <textarea name="content" placeholder="Ajouter un commentaire"></textarea>
                                <button type="submit">Commenter</button>
                            </form>

                            <div class="comments">
                                <?php foreach (CommentRepository::getComments($post->getId()) as $comment): ?>
                                    <div class="comment">
                                        <p><?= htmlspecialchars($comment['content']) ?></p>
                                        <small>Par utilisateur <?= htmlspecialchars($comment['userId']) ?> le <?= htmlspecialchars($comment['createdAt']) ?></small>
                                        <div class="post-actions">
                                            <div class="like-buttons">
                                                <?php $commentLikeCount = LikeRepository::getLikeCount($comment['id'], 'comment'); ?>
                                                <?php if (LikeRepository::hasUserLiked($_SESSION['user_id'], $comment['id'], 'comment')): ?>
                                                    <form action="/RemoveLike" method="post">
                                                        <input type="hidden" name="targetId" value="<?= $comment['id'] ?>">
                                                        <input type="hidden" name="type" value="comment">
                                                        <button type="submit"> (<?= $commentLikeCount ?>)</button>
                                                    </form>

                                                <?php else: ?>
                                                    <form action="/AddLike" method="post">
                                                        <input type="hidden" name="targetId" value="<?= $comment['id'] ?>">
                                                        <input type="hidden" name="type" value="comment">
                                                        <button type="submit"> (<?= $commentLikeCount ?>)</button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Autres boutons pour éditer/supprimer le commentaire -->
                                            <?php if ($comment['userId'] == $_SESSION["user_id"]): ?>
                                                <div class="comment-actions">
                                                    <form action="/DeleteComment" method="post">
                                                        <input type="hidden" name="commentId" value="<?= $comment['id'] ?>">
                                                        <button type="submit" class="btn btn-delete" title="Supprimer">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>

                                                    <?php if (isset($_POST['updateComment']) && $_POST['updateComment'] == $comment['id']): ?>
                                                        <form action="/EditComment" method="post">
                                                            <input type="hidden" name="commentId" value="<?= $comment['id'] ?>">
                                                            <textarea name="content" required><?= htmlspecialchars($comment['content']) ?></textarea>
                                                            <button type="submit" class="btn btn-save" title="Enregistrer">
                                                                <i class="fas fa-save"></i>
                                                            </button>
                                                        </form>
                                                    <?php else: ?>
                                                        <form action="" method="post">
                                                            <button type="submit" name="updateComment" value="<?= $comment['id'] ?>" class="btn btn-edit" title="Modifier">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </main>
    </body>

</html>