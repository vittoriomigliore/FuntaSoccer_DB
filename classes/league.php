<?php
class League{
  const base_url = 'https://sofifa.com';

  private $id;
  private $name;
  private $teams = array();

  public function __construct($id,$name,$url) {
    $this->id = $id;
    $this->name = $name;
    $this->fetchTeams($url);
  }

  private function fetchTeams($url){
    $html = new simple_html_dom();

    //load league page
    $html->load_file(self::base_url.$url);

    //get teams table
    $teams_rows = $html->find('.table tbody tr');
    $rows_lenght= sizeof($teams_rows);

    for($i=1;$i<$rows_lenght;$i++) {  //skip first (table head)
      //fetch team href
      $team_url = $teams_rows[$i]->find('a',0)->href;

      //create a new Team object
      $team= new Team($this->id , $team_url);
      //insert Team in league
      array_push($this->teams, $team);
    }
  }

  private static function echoArray($array){
    $output = '[';
    foreach($array as $index => $item){
      if ($index == 0) {
        $output .= strval($item);
      }else {
        $output .= ', '.strval($item);
      }
    }
    $output .= ']';
    return $output;
  }

  public function __toString(){
    return '{ "League": { "id": '.$this->id.', "name": "'.$this->name.'" , "teams": '.self::echoArray($this->teams).'}}';
  }
}
 ?>
