<?php
  require('./lib/simple_html_dom.php');
  require('./classes/league.php');
  require('./classes/team.php');
  require('./classes/player.php');


  //  Set this with data of league you want to scrape
  //  (id,name,relative path)
  $league = new League(31,'Calcio Serie A','/league/31');

  //print out league scraped
  echo $league;

  //under costruction
  class Nation {
    private $id;
    private $name;

    public function __construct($id,$name){
      $this->id=$id;
      $this->name=$name;
    }
  }


 ?>
