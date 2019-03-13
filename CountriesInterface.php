<?php

interface CountriesInterface {
  public function searchByKey($key);
  public function searchByValue($value);
  public function count();
  public function getAll();
  public function filter($search);
}