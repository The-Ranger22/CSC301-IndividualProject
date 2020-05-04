<?php


class Admin
{
    public static function verifyAdmin($strict = false)
    {
        if ($strict) {
            if (session_logged('user')) {
                if ($_SESSION['role'] != 2) {
                    header('Location: ../main/index.php');
                }
            }
        } else {
            if (session_logged('user')) {
                if ($_SESSION['role'] != 2 && $_SESSION['role'] != 3) {
                    header('Location: ../main/index.php');
                }
            }
        }
    }

    public static function displayAdminOverlay($admin_path, $public_path)
    {
        if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) {
            ?>
            <div style="position: fixed; bottom: 10px; right: 10px">
                <a class="btn btn-outline-danger" href="<?= $admin_path ?>">Admin</a>
                <a class="btn btn-outline-success" href="<?= $public_path ?>">Site</a>
            </div>
            <?php
        }
    }

    public static function displayAnalytics()
    {
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);

        $admin_query = $db->query("SELECT * FROM user WHERE role=2");
        $manager_query = $db->query("SELECT * FROM user WHERE role=3");
        $total_user_query = $db->query("SELECT * FROM user");
        $deactivated_user_query = $db->query("SELECT * FROM user WHERE role=0");
        $post_query = $db->query("SELECT * FROM post");

        ?>
        <div>Admins: <?= $admin_query->rowCount() ?></div>
        <div>Managers: <?= $manager_query->rowCount() ?></div>
        <div>Current Users (Including
            Admins): <?= $total_user_query->rowCount() - $deactivated_user_query->rowCount() ?></div>
        <div>Deactivated Users: <?= $deactivated_user_query->rowCount() ?></div>
        <div>Overall Total Users: <?= $total_user_query->rowCount() ?> </div>
        <div>Total Posts: <?= $post_query->rowCount() ?> </div>
        <?php
    }

    public static function displayManageUsers()
    {
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $user_query = $db->query("SELECT * FROM user");
        if ($_SESSION['role'] == 2) {
            ?>
            <div style="position: absolute; top: 90px; right: 10px">
                <a class="btn btn-success" href="adminCreate.php">Create User</a>
            </div>
            <?php
        }
        while ($user = $user_query->fetch()) {
            $post_query = $db->query("SELECT * FROM post WHERE author_id=" . $user['user_id']);
            ?>
            <div class="row standard-container cstm-border" style="margin-bottom: 5px">
                <div class="col"><?= $user["username"] ?></div>
                <div class="col">Joined: <?= $user["date_registered"] ?></div>
                <div class="col">Posts created: <?= $post_query->rowCount() ?></div>
                <?php
                $classString = "";
                $statusString = "";
                if ($user['role'] == 0) {
                    $classString = "c-red";
                    $statusString = "deactivated";
                } else if ($user['role'] == 2) {
                    $classString = "c-yellow";
                    $statusString = "administrator";
                } else if ($user['role'] == 3) {
                    $classString = "c-orange";
                    $statusString = "manager";
                } else {
                    $classString = "c-green";
                    $statusString = "active";
                }
                ?>
                <div class="col">Status: <p class="<?= $classString ?>"><?= $statusString ?></p></div>
                <?php
                if ($_SESSION['role'] == 2) {
                    if ($statusString != "deactivated") {
                        ?>
                        <a class="btn btn-warning" style="margin-right: 5px"
                           href="adminEdit.php?id=<?= $user["user_id"] ?>">Edit User</a>
                        <button class="btn btn-danger"
                                onclick="confirmDelete('adminDelete.php?id=<?= $user["user_id"] ?>','Are you sure you want to delete <?= $user["username"] ?>?')">
                            Delete User
                        </button>

                        <?php
                    } else {
                        ?>
                        <a class="btn btn-primary" href="adminRestore.php?id=<?= $user["user_id"] ?>">Restore User</a>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }
    }

    public static function displayManagePosts()
    {
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $user_query = $db->query("SELECT * FROM user");

        ?>
        <div style="position: absolute; top: 90px; right: 10px">
            <a class="btn btn-success" href="adminPostCreate.php">Create Post</a>
        </div>
        <?php


        while ($user = $user_query->fetch()) {
            $post_query = $db->query("SELECT * FROM post WHERE author_id=" . $user['user_id']);
            if ($post_query->rowCount() > 0) {
                ?>
                <h5 class="header-text"><?= $user['username'] ?></h5>
                <div class="row">
                    <div class="col standard-container cstm-border">
                        <?php
                        while ($post = $post_query->fetch()) {
                            ?>
                            <div>
                                <div class="row">Title: <?= $post['title'] ?></div>
                                <div class="row">Content: <?= $post['content'] ?></div>
                                <a href="../main/post_detail.php?pid=<?= $post["post_id"] ?>">View Post</a>

                                <div style="float:right">
                                    <a class="btn btn-warning" href="adminPostEdit.php?pid=<?= $post["post_id"] ?>">Edit Post</a>
                                    <button class="btn btn-danger"
                                            onclick="confirmDelete('adminPostDelete.php?pid=<?= $post["post_id"] ?>','Are you sure you want to delete this post? This action cannot be undone!')">
                                        Delete Post
                                    </button>
                                </div>
                            </div>
                            <hr class="cstm-border">

                            <?php
                        }
                        ?>
                    </div>
                </div>
                <br>
                <?php
            }
        }

    }

    public static function createUser()
    {
        $formArr = [
            [
                'tag' => 'input',
                'name' => 'status',
                'type' => 'hidden',
                'value' => 'success'
            ],
            [
                'tag' => 'input',
                'name' => 'username',
                'type' => 'text',
                'placeholder' => 'E.g. User1',
                'required' => true
            ],
            [
                'tag' => 'input',
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'password',
                'required' => true
            ],
            [
                'tag' => 'input',
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'mail@me.com',
                'required' => true
            ],

            [
                'tag' => 'select',
                'name' => 'month',
                'isINT' => true,
                'isSTRING' => false,
                'options' => [
                    1,
                    12
                ]
            ],
            [
                'tag' => 'select',
                'name' => 'day',
                'isINT' => true,
                'isSTRING' => false,
                'options' => [
                    1,
                    30
                ]
            ],
            [
                'tag' => 'select',
                'name' => 'year',
                'isINT' => true,
                'isSTRING' => false,
                'options' => [
                    1920,
                    2020
                ]
            ],
            [
                'tag' => 'input',
                'name' => 'admin',
                'type' => 'hidden',
                'value' => 'no',
                'required' => false
            ],
            [
                'tag' => 'input',
                'name' => 'admin',
                'type' => 'checkbox',
                'value' => 'yes',
                'required' => false
            ]

        ];
        pageHeaderHTML('Admin Sign up');
        addHeaderHTML("Zeitgeist/Admin/Sign_Up", 2);
        startContainerHTML();
        if (!(isset($_POST['status']))) {
            generateHTMLForm($formArr);
        } else if ($_POST['status'] == 'success') {
            echo("User created successfully!");
        }
        endContainerHTML();
        pageFooterHTML();
        echo(sign_up());
    }

    public static function editUser($userID)
    {
        $database = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $user_data = $database->query('SELECT * FROM user WHERE user_id=' . $userID);
        $user_data = $user_data->fetch();
        $details = json_decode($user_data['details'], true);
        if (isset($_POST['save'])) {
//            if(isset($_POST['role'])){
//                if($_POST['role'] == 'admin'){
//                    $_POST['admin'] = 2;
//                }
//            }
            $user = new User();
            $user->createUserFromID($userID);
            $user->updateUser($_POST['username'], $_POST['password'], $_POST['email'], $_POST['title'], $_POST['quote'], $_POST['bio'], intval($_POST['role']));
            header("Location: index.php");
        }
        pageHeaderHTML('Admin Sign up');
        addHeaderHTML("Editing: " . $user_data['username'], 2);
        startContainerHTML();
        ?>
        <div class="col">
            <form class="row" action="adminEdit.php?id=<?= $_GET['id'] ?>" method="post">
                <div class="col-4">
                    <h6 class="header-text">Username</h6>
                    <label for="username"></label>
                    <input id="username" type="text" name="username" value="<?= $user_data['username'] ?>">
                    <br>
                    <h6 class="header-text">Password</h6>
                    <label for="password"></label>
                    <input id="password" type="text" name="password" value="<?= $user_data['password'] ?>">
                    <br>
                    <h6 class="header-text">Email</h6>
                    <label for="email"></label>
                    <input id="email" type="text" name="email" value="<?= $user_data['email'] ?>">
                    <h6 class="header-text">Title</h6>
                    <label for="title"></label>
                    <input id="title" type="text" name="title" value="<?= $details['title'] ?>">
                    <br>
                    <h6 class="header-text">Quote</h6>
                    <label for="quote"></label>
                    <input id="quote" type="text" name="quote" value="<?= $details['quote'] ?>">
                    <br>
                </div>
                <div class="col-8">
                    <h6 class="header-text">Bio</h6>
                    <label for="bio"></label>
                    <textarea id="bio" style="width: 75%; height: 80%" type="text"
                              name="bio"><?= $details['bio'] ?></textarea>
                    <br>
                </div>
                <span style="margin-right: 5px; position:absolute; right: 350px; bottom: 10px">
                    <label for="user"></label>
                    User: <input id="user" type="radio" name="role" value="1"
                                 <?= ($user_data['role'] == 1) ? "checked" : "" ?>>
                    <label for="manager"></label>
                    Manager: <input id="manager" type="radio" name="role" value="3"
                                    <?= ($user_data['role'] == 3) ? "checked" : "" ?>>
                    <label for="admin"></label>
                    Administrator: <input id="admin" type="radio" name="role" value="2"
                                          <?= ($user_data['role'] == 2) ? "checked" : "" ?>>

                </span>
                <span style="margin-right: 5px; position:absolute; right: 90px; top: 5px"><button
                            class="btn btn-primary" name="save" value="saved">Save</button></span>
                <span style="margin-right: 5px; position:absolute; right: 10px; top: 5px"><a class="btn btn-secondary"
                                                                                             href="index.php">Cancel</a></span>
                <label for="form_id"></label>
                <input id="form_id" type="hidden" name="id" value="<?= $_GET['id'] ?>">
            </form>
        </div>
        <?php
        endContainerHTML();
        pageFooterHTML();
    }

    public static function deleteUser($userID)
    {
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $delete_query = $db->prepare("UPDATE user SET role=0 WHERE user_id=?");
        $delete_query->execute([$userID]);
        header("Location: index.php");
    }

    public static function restoreUser($userID)
    {
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $delete_query = $db->prepare("UPDATE user SET role=1 WHERE user_id=?");
        $delete_query->execute([$userID]);
        header("Location: index.php");
    }

    public static function createPost(){
        if(isset($_POST["create_status"])){
            $post = new Post();
            $post->add_post($_POST["title"], $_POST["content"], $_SESSION['user_id']);
            $_POST = [];
            $_GET = [];
            header('Location: index.php');
        }
        pageHeaderHTML("Create Post");
        echo("<h3 class=\"header-text\">Create Post</h3>");
        startContainerHTML();
        ?>
        <div class="col">
            <form method="post">
                <div class="form-group">
                    <label for="title-input" class="header-text">Title</label>
                    <input id="title-input" class="form-control" name="title" type="text" required>
                </div>
                <div>
                    <label for="content-input" class="header-text">Content</label>
                    <textarea id="content-input" class="form-control" name="content" rows="15" required></textarea>
                </div>
                <input type="hidden" name="create_status" value="set">
                <button type="submit" class="btn header-text float-right" style="text-decoration: underline">Submit</button>
            </form>
        </div>
        <?php

        endContainerHTML();
        pageFooterHTML();
    }
    public static function editPost($postID){
        $post = new Post();
        $post->load_post($postID);

        if(isset($_POST['edit_status'])){
            $post->set_title($_POST['title']);
            $post->set_content($_POST['content']);
            $post->edit_post();
            $_POST = [];
            header("Location: index.php");
        }

        pageHeaderHTML("Edit Post");
        addHeaderHTML("Edit Post");
        startContainerHTML();
        ?>
        <div class="col">
            <form method="post">
                <div class="form-group">
                    <label for="title-input" class="header-text">Title</label>
                    <input id="title-input" class="form-control" name="title" type="text" value="<?= $post->title ?>" required>
                </div>
                <div>
                    <label for="content-input" class="header-text">Content</label>
                    <textarea id="content-input" class="form-control" name="content" rows="15"  required><?= $post->content ?></textarea>
                </div>
                <input type="hidden" name="edit_status" value="set">
                <button type="submit" class="btn header-text float-right" style="text-decoration: underline">Submit</button>
            </form>
        </div>
        <?php
        endContainerHTML();
        pageFooterHTML();
    }
    public static function deletePost($postID){
        $post = new Post();
        $post->load_post($postID);
        $post->delete_post();
        header("Location: index.php");
    }
}