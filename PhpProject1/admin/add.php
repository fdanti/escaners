<div align="center">
    <h2>Afegir nou escàner</h2>
    <div id="help"><p style="padding: 0px; margin:5px;">Introdueix a continuació les dades de l'escàner:</p></div>
    <form id="form1" name="form1" method="POST"  onsubmit="return submitForm('add.php','#help',true);">
        <table border="0">
            <tr>
                <td align="right" style="padding-right: 30px;">Direcció ip de l'escàner:</td>
                <td><input type="text" id='ip' name='ip' size="15" maxlength="15" /></td>
            </tr>
            <tr>
                <td align="right" style="padding-right: 30px;">Nom per a mostrar:</td>
                <td><input type="text" id='nom' name='nom' size="32" maxlength="32" /></td>
            </tr>
            <tr>
                <td align="right" style="padding-right: 30px;">Notes addicionals:</td>
                <td><textarea cols="32" rows="6" id='notes' name='notes' /></td>
            </tr>
            <tr>
                <td align="right" style="padding-right: 30px;">Llistat d'usuaris a crear/afegir <span style="font-size: 70%; font-weight: bolder; color: #FF0000;">(separats per coma)</span>:</td>
                <td><input type="text" id='usuaris' name='usuaris' size="32" maxlength="32" /></td>
            </tr>
        </table>
        <input id="submit" name="submit" type="submit" value="Registrar" style="margin-top:20px; margin-left:200px;" />
    </form>
</div>