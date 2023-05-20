
<?php
    require_once APPROOT."/views/inc/header.php";
    
    
?>
    <div class="container">
    <?php require_once APPROOT.'/views/inc/navbar.php'; ?>
        <div class=" flex-center-colum">
            <h2 class="m-t2">Register With Us</h2>

        </div>
        <div>
                <form action="<?= URLROOT ?>users/register" method="POST" class="m-t1">
                    <div>
                        <label for="name">Full Name</label>
                        <input type="text" name='name' class="" value="<?= $data['name'] ?>"> <br>
                        <small><?= empty($data['name_err'])?'':'Enter your fullname'; ?></small>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name='email' class="" value="<?= $data['email'] ?>"> <br>
                        <small><?= empty($data['email_err'])?'':$data['email_err']; ?></small>
                    </div>
                    <div>
                        <label for="pwd">Password</label>
                        <input type="password" name='pwd' class="" value="<?= $data['password'] ?>"> <br>
                        <small><?= empty($data['password_err'])?'':$data['password_err']; ?></small>
                    </div>
                    <div>
                        <label for="cpwd">Confirm Password</label>
                        <input type="password" name='cpwd' class="" value="<?= $data['confirm_password']; ?>"> <br>
                        <small><?= empty($data['confirm_password_err'])?'':$data['confirm_password_err']; ?></small>
                    </div>
                    
                    <section class="flex-space-betwn">
                        <input type="submit" value="Submit">
                        <a href="<?= URLROOT ?>users/signin">Sign in</a>

                    </section>
                </form>
                
            </div>

    </div>

    <?php
    require_once APPROOT."/views/inc/footer.php";