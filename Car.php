<?php

class Car {
  protected int $fuel;
  protected int $velocity;
  private string $owner;

  public function __construct(string $owner) {
    $this->owner = $owner;
    $this->fuel = 0;
    $this->velocity = 0;
  }

  public function speedUp(int $value = 1): bool {
    if ($this->fuel > $value) {
      $this->velocity += $value;
      $this->fuel -= $value;

      return TRUE;
    }

    return FALSE;
  }

  public function speedDown($value = 1) {
    $this->velocity -= $value;
    if ($this->velocity < 0) {
      $this->velocity = 0;
    }
  }

  public function sell($newOwner) {
    $this->owner = $newOwner;
  }

  public function refuel() {
    $this->fuel = 100;
  }

  public function getFuel() : int {
    return $this->fuel;
  }

  public function getVelocity() : int {
    return $this->velocity;
  }

  public function getOwner() : string  {
    return $this->owner;
  }
}