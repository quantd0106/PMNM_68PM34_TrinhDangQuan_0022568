<?php
class App
{
    public function __construct()
    {
        // if (isset($_GET['url'])) {
        // echo($_GET['url']);
        // }

        $urlProcessed = $this->UrlProcess();
        var_dump($urlProcessed);
    }

    public function UrlProcess(){
        if(isset($_GET['url'])){
            // return explode('/', filter_var(trim($_GET['url'], '/')));
            return explode('/', filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
?>