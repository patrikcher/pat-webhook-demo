<?php

class Book {
	private $recid, $title, $author, $thumbnail, $bookurl, $review, $filepath;
	
	public function __construct($recid='', $title='', $author='', $thumbnail='', $bookurl='', $review='', $filepath='') {
		$this->recid = $recid;
		$this->title = $title;
		$this->author = $author;
		$this->thumbnail = $thumbnail;
		$this->bookurl = $bookurl;
		$this->review = $review;
		$this->filepath = $filepath;
		
		//echo 'Constructed an instance of ', __CLASS__, ' with title=', $this->title, ".\n";
	}
	
	public function __destruct() {
		echo 'Destructed instance ', $this, ' of ', __CLASS__, ".\n";
	}
	
	public function getRecId() {
		return $this->recid;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function getThumbnail() {
		return $this->thumbnail;
	}
	
	public function getBookUrl() {
		return $this->bookurl;
	}
	
	public function getReview() {
		return $this->review;
	}
	
	public function getFilepath() {
		return $this->filepath;
	}
	
	public function setRecId($recid) {
		$this->recid = $recid;
	}
		
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function setAuthor($author) {
		$this->author = $author;
	}
	
	public function setThumbnail($thumbnail) {
		$this->thumbnail = $thumbnail;
	}
	
	public function setBookUrl($bookurl) {
		$this->bookurl = $bookurl;
	}
	
	public function setReview($review) {
		$this->review = $review;
	}
	
	public function setFilepath($filepath) {
		$this->filepath = $filepath;
	}
	
	public function __toString() {
		return __CLASS__ . '[title=' . $this->title . ']';
	}
}

?>