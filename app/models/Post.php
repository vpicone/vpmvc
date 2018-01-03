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