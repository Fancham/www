<?php
function getPageCourante($page) {
    // Par defaut page 1
    $pageCourante=1;
    
    // Est-ce que le param�tre $page est dans l'url
    if(isset($_GET[$page])) {
        // Si present alors $pageCourante=numero de page du paramètre
        $pageCourante=$_GET[$page]; 
    }
    return $pageCourante;
}
?>