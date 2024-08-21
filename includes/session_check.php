<?php
require_once MODEL_DIR.'Authorization.php';

$auth = new Authorization($db);

if (PAGE_NAME == 'logout') {
    if ($user->isLoggedIn() === false) {
        $referer = (REFERER == '' OR REFERER == NULL) ? BASE_URL.'login' : REFERER;
        header('Location: '.$referer);
        exit();
    }
} else {
    $pageInfo = $auth->getPage(PAGE_NAME);
    
    if ($pageInfo->type == 'admin_page') {
        if ($user->isLoggedIn()) {
            if($auth->hasPagePermission($user->currentUser->id, PAGE_NAME) == false){
                $utility->redirectToPreviewPage();
            } else {
                if($auth->isAuthorized(PAGE_NAME) == false) {
                    $utility->showAuthorizeForm(PAGE_NAME);
                }
            }
        } else {
            header('Location: '.BASE_URL.'login');
        }
    } 
    
    elseif ($pageInfo->type == 'all_user_page') {
        if ($user->isLoggedIn() == false) {
            header('Location: '.BASE_URL.'login');
        }
    }
    
    elseif ($pageInfo->type == 'auth_page') {
        if ($user->isLoggedIn() === true) {
            $utility->redirectToPreviewPage();
        }
    }
}