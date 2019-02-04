<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<TITLE>Wyniki ankiety</TITLE>
</HEAD>
<BODY>
<CENTER>
<H2>Wyniki ankiety</H2>
<?PHP

function printResults()
{
  if(isSet($_POST["vote"])){
    $odp = $_POST["vote"];
  }
  else{
    $odp = "";
  }

  if($odp == ""){
    echo("Odpowiedz");
  }
  else{
    $link = mysql_connect("localhost", "login", "haslo");
    $flag = mysql_select_db("nazwa_bazy");
    if(!$link || !$flag){
      echo("Problem z połšczeniem z baza danych.");
      return false;
    }

    $query = "UPDATE tabela SET VOTES = VOTES + 1 WHERE NAME = '".$odp."'";
    if(!$result = mysql_query($query)){
      echo("Problem z baza danych. Odrzucone zapytanie.");
      return false;
    }

    $query = 'SELECT SUM(VOTES) FROM tabela';
    if(!$result = mysql_query($query)){
      echo("Problem z baza danych. Odrzucone zapytanie.");
      return false;
    }

    if(!$row = mysql_fetch_row($result)){
      echo("Problem z baza danych. Odrzucone zapytanie.");
      return false;
    }

    $votes_no = $row[0];

    $query = "SELECT NAME, VOTES, VOTES * 100 /".$votes_no;
    $query .= " AS PROC FROM tabela ORDER BY VOTES DESC";
    if(!$result = mysql_query($query)){
      echo("Problem z baza danych. Odrzucone zapytanie.");
      echo("Problem z baza danych. Odrzucone zapytanie.");
      result;
    }
    echo("<TABLE border='1'>");
    $kolor_nazwa = "Nazwa koloru";
    $ile_glosow = "Liczba głosów";
    $proc_glosow = "Procent głosów";
    include("odp_tab_row.inc");
    echo("$code");

    while($row = mysql_fetch_array($result)){
      $kolor_nazwa = $row[0];
      $ile_glosow = $row[1];
      $proc_glosow = $row[2];
      include("odp_tab_row.inc");
      echo("$code");
    };
    echo("</TABLE>");
  }
}
printResults();
?>
</CENTER>
</BODY>
</HTML>