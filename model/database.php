<?php

Namespace Model;

  // connect to mongodb
  $m = new MongoClient();
  echo "Connection to database successfully";
  // select a database
  $db = $m->examplesdb;
  echo "Database examplesdb selected";
