<?php


?><div class="logo">
<img src="./media/Logo/logotop.svg" id="logo" alt="bitcoin-logo">
</div>
<nav class="navbar">
         <div class="navbar-links">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.html">
                        <span class="icon"></span>
                        <img src="./media/Icons/icon-home.png" />
                        <span class="icon-text">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="basics.html">
                        <span class="icon"></span>
                        <img src="./media/Icons/icon-basics.png" />
                        <span class="icon-text">Basics</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="more.html">
                        <span class="icon"></span>
                        <img src="./media/Icons/icon-more.png" />
                        <span class="icon-text">More</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="quiz.html">
                        <span class="icon"></span>
                        <img src="./media/Icons/icon-quiz.png" />
                        <span class="icon-text">Quiz</span>
                    </a>
                </li>

                <?php
                if(isset($_SESSION["username"]) && $_SESSION["username"] != "") {
                    // user logged in ...

                    if( $_SESSION["userrole"] == "administrator" ||  $_SESSION["userrole"] == "moderator") {
                    ?>

                        <li class="nav-item">
                            <a href="apprv-quest.html">
                                <span class="icon"></span>
                                <img src="./media/Icons/icons8-edit-24.png" />
                                <span class="icon-text">Approve Questions</span>
                            </a>
                        </li>

                    <?php
                    }
                    if( $_SESSION["userrole"] == "administrator"){ 
                    ?>  

                        <li class="nav-item">
                            <a href="manage-users.html">
                                <span class="icon"></span>
                                <img src="./media/Icons/group.png" />
                                <span class="icon-text">Manage users</span>
                            </a>
                        </li>                

                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a href="user-profile.html">
                            <span class="icon"></span>
                            <img src="./media/Icons/icon-more.png" />
                            <span class="icon-text">My profile</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="login.html">
                            <span class="icon"></span>
                            <img src="./media/Icons/logout-rounded-left.png" />
                            <span class="icon-text">logout</span>
                        </a>
                    </li>

                <?php
                }
                else {  // not in session
                ?>

                <li class="nav-item">
                    <a href="sign-up.html">
                        <span class="icon"></span>
                        <img src="./media/Icons/icon-signup.png" />
                        <span class="icon-text">Sign Up</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="login.html">
                        <span class="icon"></span>
                        <img src="./media/Icons/icon-login.png" />
                        <span class="icon-text">Login</span>
                    </a>
                </li>

                <?php
                }
                ?>

            </ul>
            <a href="#" class="toggle-button">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
        </div>
</nav>
