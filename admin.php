<?php

/*
 * Admin page for CMS
 * 
 */


 
require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";
 
if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}
 
switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  default:
    listArticles();
}
function login() 
{
 
      $results = array();
      $results['pageTitle'] = "Admin Login | Widget News";

      if ( isset( $_POST['login'] ) ) 
      {

        

          if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) 
          {

        
              $_SESSION['username'] = ADMIN_USERNAME;
              header( "Location: admin.php" );

          } 
          else 
          {

              
               $results['errorMessage'] = "Incorrect username or password. Please try again.";
               require( TEMPLATE_PATH . "/admin/loginForm.php" );
          }

       }
       else
       {

        // User has not posted the login form yet: display the form
           require( TEMPLATE_PATH . "/admin/loginForm.php" );
       }
 
}
function logout() 
{
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}
 
function editArticle() 
{
 
  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the article changes
 
    if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }
 
    $article->storeValues( $_POST );
    $article->update();
    header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['article'] = Article::getById( (int)$_GET['articleId'] );
    require( TEMPLATE_PATH . "/admin/editArticles.php" );
  }
 
}
function listArticles() 
{
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "All Articles";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }
 
  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}
 
 
 
 
?>
