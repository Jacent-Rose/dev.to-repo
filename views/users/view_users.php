<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;

/* @var $this yii\web\View */
/* @var $user app\models\Users */
/* @var $articles app\models\Articles[] */
/* @var $commentsWritten int */
/* @var $likesReceived int */

$this->title = $user->username ?? 'Profile';
?>

<style>
    .dev-to-profile {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f2f2f2;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-left:0;
        margin-right:0;
    }

    html, body{
        background-color: f2f2f2;
    }

    .profile-header {
        background-color: #fff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
        margin-bottom: 20px;
        width: 90%;
        max-width: 700px;
    }

    .profile-image-container {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto -40px auto;
        border: 3px solid #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info {
        padding-top: 50px;
    }

    .profile-name {
        margin-bottom: 5px;
        font-size: 1.4em;
        color: #333;
        font-weight: bold;
    }

    .profile-bio {
        color: #555;
        margin-bottom: 10px;
        font-size: 0.95em;
    }

    .profile-joined {
        color: #777;
        font-size: 0.85em;
    }

    .profile-joined i {
        margin-right: 5px;
    }

    .profile-actions {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .button-edit-profile {
        background-color: #e6f7ff;
        color: #007bff;
        border: 1px solid #b3e0ff;
        border-radius: 5px;
        padding: 8px 12px;
        text-decoration: none;
        font-size: 0.9em;
        display: flex;
        align-items: center;
    }

    .button-edit-profile i {
        margin-right: 5px;
    }

    .button-edit-profile:hover {
        background-color: #d9edf7;
    }

    .profile-content {
        display: flex;
        gap: 20px;
        width: 90%;
        max-width: 700px;
    }

    .profile-sidebar {
        background-color: #fff;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        width: 200px;
    }

    .sidebar-title {
        font-size: 1em;
        color: #333;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .sidebar-item {
        margin-bottom: 15px;
    }

    .sidebar-item.badges-section .badge-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .sidebar-item.badges-section .badge-icon {
        width: 30px;
        height: 30px;
        border-radius: 5px;
        overflow: hidden;
        margin-right: 10px;
    }

    .sidebar-item.badges-section .badge-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sidebar-item.badges-section .badge-info span {
        display: block;
        font-size: 0.9em;
        color: #333;
    }

    .sidebar-item.badges-section .badge-info small {
        color: #777;
        font-size: 0.8em;
    }

    .sidebar-item.stats-section .stat-item {
        display: flex;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
        color: #555;
        font-size: 0.9em;
    }

    .sidebar-item.stats-section .stat-item i {
        margin-right: 8px;
    }

    .sidebar-item.stats-section .stat-item:last-child {
        border-bottom: none;
    }

    .profile-main-content {
        flex-grow: 1;
        background-color: #fff;
        border-radius: 5px;
        padding: 80px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .profile-main-content h2 {
        margin-top: 0;
        color: #333;
        margin-bottom: 15px;
        font-size: 1.2em;
        font-weight: bold;
    }

    .post-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .post-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .post-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .post-author-image-container {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
    }

    .post-author-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .post-author-info {
        display: flex;
        flex-direction: column;
        font-size: 0.85em;
    }

    .post-author-name {
        color: #333;
        font-weight: bold;
    }

    .post-date {
        color: #777;
    }

    .post-title {
        color: #333;
        font-size: 1.1em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .post-tags {
        margin-bottom: 10px;
    }

    .post-tag {
        display: inline-block;
        background-color: #f0f0f0;
        color: #555;
        font-size: 0.75em;
        padding: 3px 8px;
        border-radius: 5px;
        margin-right: 5px;
        text-decoration: none;
    }

    .post-actions {
        display: flex;
        align-items: center;
        color: #777;
        font-size: 0.8em;
        gap: 15px;
        margin-top: 10px;
    }

    .post-action {
        text-decoration: none;
        color: #555;
        display: flex;
        align-items: center;
    }

    .post-action i {
        margin-right: 5px;
    }

    .post-action:hover {
        color: #333;
    }

    .post-read-time {
        display: flex;
        align-items: center;
    }

    .post-read-time i {
        margin-right: 5px;
    }
</style>


<div class="profile-view dev-to-profile">
    <div class="profile-header">
        <div class="profile-image-container">
            <?php if (!empty($user->profile_picture)): ?>
                <img src="<?= Url::to(['web/' . $user->profile_picture]) ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="<?= Url::to(['web/images/default.jpg']) ?>" class="" alt="Default">
            <?php endif; ?>
        </div>
        <div class="profile-info">
            <p class="profile-bio">
                <?= Html::encode($user->bio ?? '404 bio not found') ?>
                <a href="#" data-bs-toggle="modal" data-bs-target="#editBioModal" style="margin-left: 10px; font-size: 0.8em;">
                    <i class="fas fa-edit"></i>
                </a>
            </p>

            <p class="profile-joined"><i class="fa fa-birthday-cake"></i> Joined on <?= Yii::$app->formatter->asDate($user->created_at, 'MMM d, Y') ?></p>
        </div>
        <div class="profile-actions">
            <?= Html::a('<i class="fa fa-pencil"></i> Edit profile', ['users/edit-profile', 'id' => $user->id], ['class' => 'button-edit-profile']) ?>
        </div>

    </div>

    <div class="profile-content">
        <div class="profile-sidebar">
            <div class="sidebar-item badges-section">
                <h6 class="sidebar-title">Badges</h6>
                <div class="badge-item">
                    <div class="badge-icon">
                        <img src="<?= Url::to(['web/images/badges.png']) ?>" alt="Badges Image"
                            style="height: 30px; width: 30px; border-radius: 5px;">
                    </div>
                    <div class="badge-info">
                        <span>Authored</span>
                        <small><?= count($articles) ?> Posts</small>
                    </div>
                </div>
            </div>
            <div class="sidebar-item stats-section">
                <h6 class="sidebar-title">Stats</h6>
                <div class="stat-item">
                    <i class="fa fa-file-alt"></i>
                    <span><?= count($articles) ?> Posts</span>
                </div>
                <div class="stat-item">
                    <i class="fa fa-comment-dots"></i>
                    <span><?= $commentsWritten ?? 0 ?> Comments</span>
                </div>
                <div class="stat-item">
                    <i class="fa fa-heart"></i>
                    <span><?= $likesReceived ?? 0 ?> Likes</span>
                </div>
            </div>
        </div>

        <div class="profile-main-content">
            <h2>Posts</h2>
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <div class="post-item">
                        <div class="post-header">
                            <div class="post-author-image-container">
                                <?php if (!empty($article->createdBy->profile_picture)): ?>
                                    <img src="<?= Url::to(['web/' . $article->createdBy->profile_picture]) ?>"
                                        alt="Profile Picture">
                                <?php else: ?>
                                    <img src="<?= Url::to(['web/images/default.jpg']) ?>" alt="Default">
                                <?php endif; ?>
                            </div>
                            <div class="post-author-info">
                                <span class="post-author-name"><?= Html::encode($user->username ?? 'User') ?></span>
                                <span class="post-date"><?= Yii::$app->formatter->asDate($article->created_at, 'M d') ?></span>
                            </div>
                        </div>
                        <h3 class="post-title"><?= Html::a(Html::encode($article->title), ['articles/view', 'slug' => $article->slug]) ?></h3>
                        <?php if (!empty($article->articleTags)): ?>
                            <div class="post-tags">
                                <?php foreach ($article->articleTags as $articleTag): ?>
                                    <a href="<?= Url::to(['tag/view', 'name' => $articleTag->tag->name]) ?>" class="post-tag">#<?= Html::encode($articleTag->tag->name) ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="post-actions">
                            <a href="<?= Url::to(['articles/view', 'slug' => $article->slug, '#' => 'comments']) ?>" class="post-action"><i class="fa fa-comment-dots"></i> Add Comment</a>
                            <span class="post-read-time"><i class="fa fa-clock"></i> <?= $article->read_time ?? '1 min' ?> read</span>
                        </div>
                    </div>
                    <?php if (!empty($article->cover_image_file)): ?>
                        <img src="<?= Yii::getAlias('@web') . '/web/cover_images/' . $article->cover_image_file ?>" class="img-fluid mb-3" alt="Cover Image">
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No posts published yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$updateBioUrl = Url::to(['users/update-bio', 'id' => $user->id]);
?>

<div class="modal fade" id="editBioModal" tabindex="-1" aria-labelledby="editBioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="bioEditForm" method="post" action="<?= $updateBioUrl ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="editBioModalLabel">Edit Bio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <textarea name="bio" class="form-control" rows="4"><?= Html::encode($user->bio) ?></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<?php
$csrfToken = Yii::$app->request->getCsrfToken();
$bioSelector = ".profile-bio";
$bioText = Html::encode($user->bio ?? '404 bio not found');
?>

<?php
$js = <<<JS
$('#bioEditForm').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize() + '&_csrf=$csrfToken',
        success: function(response) {
            if (response.success) {
                $('#editBioModal').modal('hide');
                $('$bioSelector').html(response.bio + ' <a href="#" data-bs-toggle="modal" data-bs-target="#editBioModal"><i class="fas fa-edit"></i></a>');
            }
        }
    });
});
JS;
$this->registerJs($js);
?>
