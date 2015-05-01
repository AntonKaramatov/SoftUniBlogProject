<!DOCTYPE html>
<html>

<head>
    <title><?php echo htmlspecialchars($this->title) ?></title>
</head>

<body>
    <header>
        <ul class="menu">
            <li><a href="/">Home</a></li>            
            <li><a href="/posts">Posts</a></li>
            <li><a href="/users/login">Login</a></li>
            <li><a href="/users/register">Register</a></li>
        </ul>
        <?php if(isset($_SESSION["username"])): ?>
        	Welcome, <?=htmlspecialchars($_SESSION["username"])?>
        	<a href="/users/logout">Logout</a>
        <?php endif; ?>
    </header>
    <?php include_once('views/layouts/messages.php'); ?>
