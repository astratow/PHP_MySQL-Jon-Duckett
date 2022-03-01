<?php
class Member 
{
  public $forename;
  public $surname;

  public function getFullName(): string
  {
    return $this->forename . ' ' . $this->surname;
  }
}