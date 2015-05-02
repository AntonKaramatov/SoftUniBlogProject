<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/content/css/blog.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="/content/js/getSidebarContent.js"></script>
</head>

<body>
    <header>
        <div class="blog-masthead">
            <div class="container">
                <nav class="blog-nav">
                    <a class="blog-nav-item" href="/">Home</a>           
                    <a class="blog-nav-item" href="/posts">Posts</a>
                    <?php if(!$this->isLoggedIn()):?>
                        <a class="blog-nav-item" href="/users/login">Login</a>
                        <a class="blog-nav-item" href="/users/register">Register</a>
                    <?php endif;?>
                    <?php if($this->isAdmin()):?>
                        <a class="blog-nav-item" href="/posts/create">Create Post</a>
                        <a class="blog-nav-item" href="/tags/create">Create Tag</a>
                        <a class="blog-nav-item" href="/comments">View Comments</a>
                        <a class="blog-nav-item" href="/tags">View Tags</a></li>
                    <?php endif;?>
                    <?php if($this->isLoggedIn()): ?>            
                            <a class="blog-nav-item" href="/users/logout">Logout</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>
    <div class="container">
        <?php include_once('views/layouts/messages.php'); ?>
        <div class="row">
            <div class="col-sm-8 blog-main">