<?php
function setMenu(){
    
    $publicmenu = array(
        [
            'title' => 'Home',
            'pagetitle' => 'Home | CABH',
            'url' => '/home',
            'icon' => 'iconsminds-check',
        ],
        [
            'title' => 'Analytics',
            'pagetitle' => 'Analytics | CABH',
            'url' => '/analytics',
            'icon' => 'iconsminds-business-mens',
        ],
        [
            'title' => 'About the Program',
            'pagetitle' => 'Program | CABH',
            'url' => '/program',
            'icon' => 'iconsminds-business-mens',
        ],
        [
            'title' => 'Methodology',
            'pagetitle' => 'Methodology | CABH',
            'url' => '/methodology',
            'icon' => 'iconsminds-business-mens',
        ],
    );
    $menucode = '<ul class="nav navbar-nav ml-auto" style="flex-direction: row;">';
    foreach ($publicmenu as $menuitem) {
        $active = '';
        if (str_contains($_SESSION['config']->Request_URI, $menuitem['url'])) {
            $active = 'active';
            $_SESSION['PageTitle'] = $menuitem['pagetitle'];
            $_SESSION['PageURI'] = $menuitem['url'];
        }
        $menucode .= '<li class="nav-item ' . $active . '">';
        $menucode .= '<a href="'. $menuitem['url'] .'" class="nav-link" >'. $menuitem['title'] .'</a></li>';
    }
    $menucode .= '</ul>';   
    return $menucode;
}
?>