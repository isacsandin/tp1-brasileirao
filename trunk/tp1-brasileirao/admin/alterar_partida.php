<?
include "verifica.php";

$id = $_GET["id"];
$sql = "SELECT * FROM partida WHERE id='$id'";
$qry = mysql_query($sql) or die(mysql_error());

if (mysql_num_rows($qry) > 0) {
    $R = mysql_fetch_object($qry);
    $mandante_id = $R->mandante_id;
    $visitante_id = $R->visitante_id;
    $estadio_id = $R->estadio_id;
    $data_hora = $R->data;
    $rodada = $R->rodada;
    $data_hora = explode(" ", $data_hora);
    $data = $data_hora[0];
    $hora = $data_hora[1];

    $sql = "SELECT id,nome,estado FROM time ORDER BY time.nome";
    $rs = mysql_query($sql) or die(mysql_error());
    $table = array();
    $i = 0;
    while ($row = mysql_fetch_array($rs)) {
        $table[$i++] = $row;
    }

    $sql = "SELECT id,nome FROM estadio ORDER BY nome";
    $rs = mysql_query($sql) or die(mysql_error());
    $estadio = array();
    $i = 0;
    while ($row = mysql_fetch_array($rs)) {
        $estadio[$i++] = $row;
    }
} else {
    echo "Tabela sem registros.";
    die();
}
?>
<form name="form_alterar" method="POST" action="?acao=executa_alterar_partida">

    <table>
        <tr>
            <td>Mandante:</td>
            <td>    
                <select name="mandante"  id="select_mandante">
                    <?
                    $i = 0;
                    while ($i < count($table)) {
                        if ($i == $mandante_id) {
                            echo "<option value='" . utf8_encode($table[$i]['id']) . "'selected='selected'>" . utf8_encode($table[$i]['nome'] . "-" . $table[$i]['estado']) . "</option>\n  ";
                        } else {
                            echo "<option value=\"" . utf8_encode($table[$i]['id']) . "\">" . utf8_encode($table[$i]['nome'] . "-" . $table[$i]['estado']) . "</option>\n  ";
                        }
                        $i++;
                    }
                    ?>
                </select>
            </td>
        </tr>       
        <tr>	
            <td>Visitante:</td>
            <td>
                <select name="visitante">
                    <?
                    $i = 0;
                    while ($i < count($table)) {
                        if ($i == $visitante_id) {
                            echo "<option value='" . utf8_encode($table[$i]['id']) . "'selected='selected'>" . utf8_encode($table[$i]['nome'] . "-" . $table[$i]['estado']) . "</option>\n  ";
                        } else {
                            echo "<option value=\"" . utf8_encode($table[$i]['id']) . "\">" . utf8_encode($table[$i]['nome'] . "-" . $table[$i]['estado']) . "</option>\n  ";
                        }
                        $i++;
                    }
                    ?>
                </select>
            </td>
        </tr>     
        <tr>
            <td>Estádio:</td>
            <td>
                <select name="estadio">
                    <?
                    $i = 0;
                    while ($i < count($estadio)) {
                        if ($i == $estadio_id) {
                            echo "<option value='" . utf8_encode($estadio[$i]['id']) . "'selected='selected'>" . utf8_encode($estadio[$i]['nome']) . "</option>\n";
                        } else {
                            echo "<option value=\"" . utf8_encode($estadio[$i]['id']) . "\">" . utf8_encode($estadio[$i]['nome']) . "</option>\n  ";
                        }
                        $i++;
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Data (dd/mm/aaaa): </td>
            <td><input type="text" name="data" id="data_2" size="10" maxlength="10" value="<? echo utf8_encode($data); ?>"></td>
        </tr>
        <tr>
            <td>Hora (hh:mm):</td>
            <td><input type="text" name="hora" id="hora" size="5" maxlength="5" value="<? echo utf8_encode($hora); ?>"></td>
        </tr>
        <tr>
            <td>Rodada:</td>
            <td><input type="text" name="rodada" id="rodada" size="5" maxlength="5" value="<? echo utf8_encode($rodada); ?>"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Alterar"></td>
        </tr> 
    </table>
    <input type="hidden" name="id" value="<? echo $id; ?>">

</form>

