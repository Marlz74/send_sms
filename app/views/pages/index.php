
<?php
    require_once APPROOT."/views/inc/header.php";
    
?>
    <div class="container">
    <?php require_once APPROOT.'/views/inc/navbar.php'; ?>
        <div class="intro flex-center-colum">
            <h1><?= $data['title']; ?></h1>
            <?php

            switch(isset($data['status'])){
                case true:
                    flashMessage(true,'Message Sent');
                    break;
                default:
                    flashMessage(null,'Sorry, an unexpected error occured..');
                    
            }
                
            
            ?>
            <form action=""  method="POST">
                <div class="m-b1">
                    <input type="number" name="number" placeholder="Enter reciever phone number" min="0"  required value="<?= !empty($data['phone_number'])?$data['phone_number']:'' ?>">
                    <small ><?= !empty($data['phone_number_err'])?$data['phone_number_err']:'' ?></small>
                </div>
                <div class="m-b1">
                    <textarea name="message" placeholder="Enter message"  required value="<?= !empty($data['message'])?$data['message']:''; ?>"></textarea>
                    <small><?= !empty($data['message_err'])?$data['message_err']:'' ?></small>
                </div>
                <button type="submit" class="btn" name="send">Send SMS</button>
            </form>
        </div>

    </div>

    <?php
    require_once APPROOT."/views/inc/footer.php";