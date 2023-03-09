<?php

interface CountriesInterface {
  public function searchByKey(string $key);
  public function searchByValue(string $value);
  public function count();
  public function getAll();
  public function filter(string $search);
}