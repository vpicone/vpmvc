# VP-MVC

## Introduction

Create CRUD apps with PHP quickly.
This project contains libraries to handle database interfacing with [PDO](http://php.net/manual/en/book.pdo.php) as well as Controller library for routing.

## Code Samples

### Example Model

```php
<?php
class Post
{
  private $db;

  public function __construct()
  {
    // Create reference to database object that interacts with the database.
    $this->db = new Database;
  }

  public function getPosts()
  {
    // Use query function and give a valid SQL statement.
    $this->db->query("SELECT * FROM posts");

    // resultSet is used when an entire row is expected.
    return $this->db->resultSet();

  }
}
```

### Example Controller

```php
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
```

### Example View

```php
<?php require APPROOT . '/views/inc/header.php'; ?>
  <h1><?php echo $data['title']; ?></h1>
  <ul>
    <?php foreach($data['posts'] as $post) : ?>
      <li><?php echo $post->title; ?></li>
    <?php endforeach; ?>
  </ul>
<?php require APPROOT . '/views/inc/footer.php'; ?>
```

## Installation

1. Replace the "\_EXAMPLE_DATA\_" strings in `/app/config/config.php`

   * Database info (host, credentials, name)
   * `URLROOT` - used for links.

2. Change the RewriteBase directory in `/public/.htaccess`
   * Replace \_EXAMPLE\_ with the install directory.
   * This should be the parent directory to `/public/`
   * Be sure not to remove the slashes.

3) To **use** the example model and view:

   * Create a MySQL database in phpmyadmin using the same name used in the config file.
   * Add a 'posts' table to the database. Posts should have an id and a title column. The id is typically set to auto-increment (AI) and primary index.

4) To **remove** the example model and view:
   * Delete `/app/models/Post.php`
   * Delete `/app/views/pages/about.php`
   * Delete `/public/css/style.css`
   * Delete the content inside the `index` function of `/app/controllers/Pages`.
   * Delete the `about` method of `/app/controllers/pages`.

## Project Structure

```
.
├── README.md
├── app
│   ├── bootstrap.php
│   ├── config
│   │   └── config.php
│   ├── controllers
│   │   └── Pages.php
│   ├── helpers
│   ├── libraries
│   │   ├── Controller.php
│   │   ├── Core.php
│   │   └── Database.php
│   ├── models
│   │   └── Post.php
│   └── views
│       ├── inc
│       │   ├── footer.php
│       │   └── header.php
│       └── pages
│           ├── about.php
│           └── index.php
└── public
    ├── css
    │   └── style.css
    ├── img
    ├── index.php
    └── js
        └── main.js

13 directories, 15 files
```
