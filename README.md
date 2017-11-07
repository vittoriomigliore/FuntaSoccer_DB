# Funta_Soccer-DB

PHP script to create and populate FuntaSoccer database by scraping of sofifa.com

## Getting Started
Choose a league from [https://sofifa.com/leagues](https://sofifa.com/leagues) and just run this under php server.

### Prerequisites

None

## Usage

Set the league you want to scrape in index.php

```
$league = new League(league_id, name_of_league , relative_path_of_league);
```

You easily find league_id in the path of league.
In my case

```
$league = new League(31,'Calcio Serie A','/league/31');
```

place script in a directory, run php and... wait

## Info returned

The script will return JSON formatted object of this form:

```
League: id, name
Team: id, name, logo-url, league-id
Player: id, name, team-id, age, general-skill,
        value, face-image-url, nation (not id yet),
        starting role (not id yet), roles (not ids yet)
```
## Notes

The script doesn't enter the player page.
For now I don't need so specific information about players.

## Built With

* [PHP Simple HTML DOM Parser](http://simplehtmldom.sourceforge.net) - The library used to extract from HTML
