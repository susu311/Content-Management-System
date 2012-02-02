<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
<?php
         
   require( "config.php" );
   //action - archive/viewArticle/home page
   $action = isset( $_GET['action'] ) ? $_GET['action'] : "";

   switch ( $action ) 
   {
        case 'archive':
        archive();
        break;
        case 'viewArticle':
        viewArticle();
        break;
        default:
        homepage();
   }

  function archive() 
  {  //get the array of articles and total rows from getList() article.php
      $results = array();
      $data = Article::getList();
      $results['articles'] = $data['results'];
      $results['totalRows'] = $data['totalRows'];
      $results['pageTitle'] = "Article Archive | News";
      require( TEMPLATE_PATH . "/archive.php" );
 }
 
 function viewArticle()
 {
       if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) 
       {
             homepage();
             return;
       }
 
      $results = array();
      $results['article'] = Article::getById( (int)$_GET["articleId"] );
      $results['pageTitle'] = $results['article']->title . " | News";
      require( TEMPLATE_PATH . "/viewArticle.php" );
 }
 function homepage() 
 {
      $results = array();
      $data = Article::getList(  );
      $results['articles'] = $data['results'];
      $results['totalRows'] = $data['totalRows'];
      $results['pageTitle'] = "News";
      require( TEMPLATE_PATH . "/home.php" );
 }
        ?>
    </body>
</html>
