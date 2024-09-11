<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Robust Teacher Portal</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
        <?php if(Auth::$isActive): ?>
        
        <header>
            <h2 align="left" style="color: #c13d32;">Robust Teacher Portal</h2>
            <div class="head-links">
                <a href="/RobustTeacherPortal/"> Home </a> 
                <a href="/RobustTeacherPortal/logout.php"> Logout </a> 
            </div>
        </header>
        
        <?php endif; ?>