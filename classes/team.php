<?php
class Team{
  const base_url = 'https://sofifa.com';

  private $id;
  private $name;
  private $image_url;
  private $league_id;
  private $players = array();

  public function __construct($league_id , $url) {
    $this->league_id = $league_id;
    $this->fetchTeam($url);
  }

  // Fetch Team Info
  private function fetchTeam($url){
    $html = new simple_html_dom();

    //load team page
    $html->load_file(self::base_url.$url);

    // fetch and store image
    $this->image_url = $html->find('.player img',0)->getAttribute('data-src');

    // fetch name and id
    $team_name_id = $html->find('.info h1',0)->plaintext;

    // store name
    $this->name =preg_replace('(\(ID: \d*\))','',$team_name_id);
    // store id
    $team_id;
    preg_match('!\d+!', $team_name_id, $team_id);
    $this->id=$team_id[0];

    // fetch (and store) players
    foreach($html->find('tr[class=starting],tr[class=sub],tr[class=res]') as $tr) {
      $p=new Player( $this->id, $tr );
      array_push( $this->players, $p );
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
    return '{ "Team" : { "id" : '.$this->id.', "name" : "'.$this->name.'",
      "image_url" : "'.$this->image_url.'", "league_id" : '.$this->league_id.',
      "players": '.self::echoArray($this->players).'
     }}';
  }
}
?>
