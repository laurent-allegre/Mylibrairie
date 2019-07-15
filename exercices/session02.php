<?php

session_start();
echo "hello".$_SESSION["pseudo"]. "!";
echo "vous habiter ". $_SESSION["ville"]. "!";