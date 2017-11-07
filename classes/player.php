<?php
class Player{
  const base_url = 'https://sofifa.com';

  private $id;
  private $name;
  private $team_id;
  private $nation_id;
  private $role;
  private $positions = array();
  private $age;
  private $total_skill;
  private $value;
  private $image_url;

  public function __construct($team_id , $row) {
    $this->team_id = $team_id;
    $this->fetchPlayer($row);
  }

  private function fetchPlayer($row){

    //fetch and store image url
    $this->image_url= $row->find('td',0)->find('img',0)->getAttribute('data-src');

    //fetch and store name
    $this->name= $row->find('td',1)->find('a',1)->plaintext;

    //fetch age
    $this->age= $row->find('td',2)->plaintext;

    //fetch total skill
    $this->total_skill= $row->find('td',3)->plaintext;

    //fetch id
    $id= $row->find('td',1)->find('a',1)->href;
    $this->id=preg_replace('(\/player\/)','',$id);

    //fetch nation
    $n_id= $row->find('td',1)->find('a',0)->href;
    $this->nation_id=preg_replace('(\/players\?na\=)','',$n_id);

    //fetch role
    $this->role= $row->find('td',5)->find('div[class!=subtitle] span',0)->plaintext;

    //fetch positions
    foreach($row->find('td',1)->find('div',1)->find('a') as $position){
      array_push($this->positions, $position->plaintext);
    }

    //fetch value
    $this->value= $row->find('td',7)->plaintext;
  }

  private static function echoArray($array){
    $output = '[';
    foreach($array as $index => $item){
      if ($index == 0) {
        $output .= '"'.strval($item).'"';
      }else {
        $output .= ', '.'"'.strval($item).'"';
      }
    }
    $output .= ']';
    return $output;
  }

  public function __toString(){
    return '{ "Player" : { "id" : '.$this->id.', "name" : "'.$this->name.'",
      "image_url" : "'.$this->image_url.'", "team_id" : '.$this->team_id.',
      "nation_id" : '.$this->nation_id.', "role" : "'.$this->role.'",
      "age" : '.$this->age.', "total_skill" : '.$this->total_skill.',
      "value" : "'.$this->value.'", "positions" : '.self::echoArray($this->positions).'
     }}';
  }


}
 ?>
