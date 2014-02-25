<?php
function getPageCourante($page) {
    // Par defaut page 1
    $pageCourante=1;
    
    // Est-ce que le paramètre $page est dans l'url
    if(isset($_GET[$page])) {
        // Si present alors $pageCourante=numero de page du paramÃ¨tre
        $pageCourante=$_GET[$page]; 
    }
    return $pageCourante;
}
?>