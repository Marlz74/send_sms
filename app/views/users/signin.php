
<?php
    require_once APPROOT."/views/inc/header.php";
    
?>
    <div class="container">
    <?php require_once APPROOT.'/views/inc/navbar.php'; ?>
        <div class=" flex-center-colum">
            <h2 class="m-t2">Sign in</h2>
            <?php isset($_SESSION['flash_alert'])? flashMessage($_SESSION['flash_alert'],$_SESSION['flash_message']):''; ?>
        </div>
        <div>
                <form action="<?= URLROOT ?>users/signin" method="POST" class="m-t1">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name='email' class=""> <br>
                        <small><?= empty($data['email_err'])?'':$data['email_err']; ?></small>
                    </div>
                    <div>
                        <label for="pwd">Password</label>
                        <input type="password" name='pwd' class="" > <br>
                        <small><?= empty($data['password_err'])?'':$data['password_err']; ?></small>
                    </div>
                    
                    <section class="flex-space-betwn">
                        <input type="submit" value="Sign in">
                        <a href="<?= URLROOT ?>users/register">Register</a>

                    </section>
                </form>
                
            </div>

    </div>

    <?php
    require_once APPROOT."/views/inc/footer.php";