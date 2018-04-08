<?php
class Book {
	private $id, $title, $author, $thumbnail, $bookurl, $review, $filepath;
	
	public function __construct($id = '0', $title = '0', $author = '0', $thumbnail = '0', $bookurl = '0', $review = '0', $filepath = '0') {
		$this->setBook($id, $title, $author, $thumbnail, $bookurl, $review, $filepath);
		echo 'Constructed an instance of ', __CLASS__, ' with value ', $this, ".\n";
	}
	
	public function __destruct() {
      echo 'Destructed instance ', $this, ' of ', __CLASS__, ".\n";
   }
   
   public function getId()   { return $this->id;   }
   
   public function getTitle()   { return $this->title;   }
   
   public function getAuthor()   { return $this->author;   }
   
   public function getThumbnail()   { return $this->thumbnail;   }
   
   public function getbookurl()   { return $this->bookurl;   }
   
   public function getReview()   { return $this->review;   }
   
   public function getFilepath()   { return $this->filepath;   }
   
   public function setBook($id = '0', $title = '0', $author = '0', $thumbnail = '0', $bookurl = '0', $review = '0', $filepath = '0') {
	   $this->id;
	   $this->title;
	   $this->author;
	   $this->thumbnail;
	   $this->bookurl;
	   $this->review;
	   $this->filepath;
   }
}
?>