<?php
    function urlRedirect($page){
        header('location: '. URLROOT.$page);
    }