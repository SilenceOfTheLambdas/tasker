<!-- 
    Tasker.io
    A task management system
    This is the login page.
    Created by: Callum-James Smith (cs18804)
 -->
 <!DOCTYPE html>
 <head>
 
     <!-- Meta stuffs -->
     <meta type='description' content='A task management website.'>
 
     <!-- CSS -->
     <link rel='stylesheet' href="css/main.css" type="text/css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
     
     <title>Task Manager</title>
 </head>
 
 <body>
 
     <header>
         <div id="logo">
             <!-- Logo goes here -->
             <h1 class="logo">Task.io</h1>
         </div>
     </header>
 
     <div class="loginBox">
         <form id="LoginForm" action="" method="post">
             <h1 id="Sign In">Sign Up</h1>
             Firstname<input type="text" name="nameUID" id="fnameInput" placeholder="Firstname...">
             Lastname<input type="text" name="nameUID" id="lnameInput" placeholder="Lastname...">
             Email<input type="email" name="emailUID" id="emailInput" placeholder="Email..."><br/>
             Password<input type="password" name="passUID" id="passInput" placeholder="Password..."><br>
             Password<input type="password" name="passUID" id="passInput" placeholder="Re-enter password..."><br>
             <button class="standard" type="submit">Submit</button>
         </form>
     </div>
 
 </body>
 
 </html>