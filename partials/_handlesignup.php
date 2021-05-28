<?php
    $showerror="false";
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include '_dbconnect.php';
        $user_email=$_POST['signupEmail'];
        $user_pass=$_POST['signuppassword'];
        $user_conform=$_POST['signupcpassword'];

        $exit_sql="select*from `users` where user_email='$user_email'";

        $result=mysqli_query($conne,$exit_sql);
        $numrows=mysqli_num_rows($result);

        if($numrows>0)
        {
            $showerror="Email is already in use";

        }
        else
        {
            if($user_pass==$user_conform)
            {
                    $hash=password_hash($user_pass,PASSWORD_DEFAULT);
                    $sql="INSERT INTO `users` (`user_email`, `user_pass`, `user_time`) VALUES ('$user_email', '$hash', current_timestamp())";
                    $result=mysqli_query($conne,$sql);
                    if($result)
                    {
                        $shoAlert=true;
                        header("Location:/forum_project/index.php?signupsuccess=true");
                        exit();
                    }
            }
            else
            {
                $showerror="Password do not match";
               
            }
        }
        header("Location:/forum_project/index.php?signupsuccess=false&error=$showerror");
    }

?>