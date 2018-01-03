<?php
class Pages extends Controller
{
  public function __construct()
  {
    // Instantiate models here using the model function inherited from Controller.
    $this->postModel = $this->model('Post');
  }

  public function index()
  {
    // This is the default method for the controller or supply data necessary
    // to render the page without paramaters.
    $posts = $this->postModel->getPosts();

    // This is an associattive array that the view will be able to access to render data.
    $data = [
      'title' => 'Welcome',
      'posts' => $posts
    ];

    // Select the view, don't include a leading slash.
    $this->view('pages/index', $data);
  }

  public function about()
  {
    // This is a sample alternate method, supply data that is necessary to construct
    // the view successfully.
    $data = [
      'title' => 'About Us'
    ];

    $this->view('pages/about', $data);
  }
}