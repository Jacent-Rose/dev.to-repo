<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $posts array // Replace with your actual post data */
/* @var $totalPostReactions int // Replace with your actual data */
/* @var $totalPostComments int // Replace with your actual data */
/* @var $totalPostViews int // Replace with your actual data */

$this->title = 'Manage Posts';
?>

<div class="manage-posts-view">
    <h1>Dashboard</h1>

    <div class="dashboard-summary">
        <div class="summary-item">
            <div class="count">0</div>
            <div class="label">Total post reactions</div>
        </div>
        <div class="summary-item">
            <div class="count">0</div>
            <div class="label">Total post comments</div>
        </div>
        <div class="summary-item">
            <div class="count">&lt; 500</div>
            <div class="label">Total post views</div>
        </div>
    </div>

    <div class="manage-area">
        <div class="sidebar-navigation">
            <ul>
                <li class="active">Posts <span class="badge">1</span></li>
                <li>Series</li>
                <li>Followers <span class="badge">12</span></li>
                <li>Following tags <span class="badge">1</span></li>
                <li>Following users <span class="badge">0</span></li>
                <li>Following organizations <span class="badge">0</span></li>
                <li>Following podcasts <span class="badge">0</span></li>
                <li>Analytics</li>
                <li>Hidden tags <span class="badge">0</span></li>
            </ul>
        </div>

        <div class="content-area">
            <div class="content-header">
                <h2>Posts</h2>
                <div class="header-actions">
                    <button class="button-secondary">Show quickie posts</button>
                    <div class="dropdown">
                        <button class="button-dropdown">Recently Created</button>
                        <div class="dropdown-content">
                            <a href="#">Recently Created</a>
                            <a href="#">Oldest First</a>
                            <a href="#">Most Views</a>
                            <a href="#">Most Reactions</a>
                            </div>
                    </div>
                </div>
            </div>

            <div class="posts-list">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="post-item">
                            <div class="post-title">
                                <?= Html::a(Html::encode($post['title']), Url::to(['view', 'id' => $post['id']])) ?>
                            </div>
                            <div class="post-meta">
                                Published: <?= Yii::$app->formatter->asDate($post['published_at'], 'MMM dd') ?>
                                Edited: <?= $post['edited_at'] ? Yii::$app->formatter->asDate($post['edited_at'], 'MMM dd') : 'N/A' ?>
                                Language: <?= Html::encode($post['language']) ?>
                            </div>
                            <div class="post-stats">
                                <span class="stat-item">
                                    <svg viewBox="0 0 24 24"><path fill="currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.53L12 21.35z"></path></svg>
                                    0
                                </span>
                                <span class="stat-item">
                                    <svg viewBox="0 0 24 24"><path fill="currentColor" d="M21.99 8c0-3.07-2.69-5.5-5.99-5.5H8c-3.07 0-5.5 2.43-5.5 5.5v8c0 3.07 2.43 5.5 5.5 5.5h8c3.3 0 5.99-2.43 5.99-5.5l-.01-8zM8 18c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm8-4c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4z"></path></svg>
                                    0
                                </span>
                                <span class="stat-item">
                                    <svg viewBox="0 0 24 24"><path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path></svg>
                                    &lt; 25
                                </span>
                            </div>
                            <div class="post-actions-list">
                                <a href="<?= Url::to(['manage', 'id' => $post['id']]) ?>">Manage</a>
                                <a href="<?= Url::to(['edit', 'id' => $post['id']]) ?>">Edit</a>
                                <div class="dropdown-dots">
                                    <button class="button-dots">...</button>
                                    <div class="dropdown-content-dots">
                                        <a href="#">Pin/Unpin</a>
                                        <a href="#">Publish/Unpublish</a>
                                        <a href="#" class="delete-post">Delete</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .manage-posts-view {
        padding: 20px;
        font-family: sans-serif;
        background-color: #f7f7f7;
        min-height: 100vh;
    }

    h1 {
        margin-bottom: 20px;
        color: #333;
    }

    .dashboard-summary {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .summary-item {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        width: 200px;
        text-align: center;
    }

    .summary-item .count {
        font-size: 2em;
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }

    .summary-item .label {
        color: #777;
        font-size: 0.9em;
    }

    .manage-area {
        display: flex;
        gap: 20px;
    }

    .sidebar-navigation {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        width: 200px;
    }

    .sidebar-navigation ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-navigation li {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        color: #555;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sidebar-navigation li.active {
        color: #007bff;
        font-weight: bold;
    }

    .sidebar-navigation li .badge {
        background-color: #ddd;
        color: #555;
        border-radius: 10px;
        padding: 2px 8px;
        font-size: 0.8em;
    }

    .content-area {
        flex-grow: 1;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .content-header h2 {
        margin: 0;
        color: #333;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .button-secondary {
        background-color: #eee;
        color: #555;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px 15px;
        cursor: pointer;
        font-size: 0.9em;
    }

    .button-secondary:hover {
        background-color: #ddd;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .button-dropdown {
        background-color: #f0f0f0;
        color: #555;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px 15px;
        cursor: pointer;
        font-size: 0.9em;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .button-dropdown::after {
        content: '\25BE'; /* Down arrow */
        margin-left: 8px;
        font-size: 0.8em;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .posts-list {
        margin-top: 20px;
    }

    .post-item {
        border-bottom: 1px solid #eee;
        padding: 15px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .post-item:last-child {
        border-bottom: none;
    }

    .post-title {
        font-weight: bold;
        color: #333;
        flex-grow: 1;
        margin-right: 10px;
    }

    .post-title a {
        text-decoration: none;
        color: inherit;
    }

    .post-title a:hover {
        text-decoration: underline;
        color: #007bff;
    }

    .post-meta {
        color: #777;
        font-size: 0.8em;
        white-space: nowrap;
        margin-right: 10px;
    }

    .post-stats {
        display: flex;
        gap: 10px;
        align-items: center;
        color: #777;
        font-size: 0.8em;
        white-space: nowrap;
        margin-right: 10px;
    }

    .post-stats svg {
        width: 16px;
        height: 16px;
        fill: currentColor;
        margin-right: 3px;
    }

    .post-actions-list {
        display: flex;
        gap: 10px;
        align-items: center;
        white-space: nowrap;
    }

    .post-actions-list a {
        color: #007bff;
        text-decoration: none;
        font-size: 0.9em;
    }

    .post-actions-list a:hover {
        text-decoration: underline;
    }

    .dropdown-dots {
        position: relative;
        display: inline-block;
    }

    .button-dots {
        background: none;
        border: none;
        color: #777;
        cursor: pointer;
        font-size: 1.2em;
        padding: 0;
        line-height: 1;
    }

    .dropdown-content-dots {
        display: none;
        position: absolute;
        right: 0;
        background-color: #f9f9f9;
        min-width: 120px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .dropdown-dots:hover .dropdown-content-dots {
        display: block;
    }

    .dropdown-content-dots a {
        color: black;
        padding: 10px 15px;
        text-decoration: none;
        display: block;
        font-size: 0.9em;
        text-align: left;
    }

    .dropdown-content-dots a:hover {
        background-color: #ddd;
    }

    .delete-post {
        color: red !important;
    }
</style>