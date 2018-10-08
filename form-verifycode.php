<tr>
    <td class="table-right-align"><p>Enter the code:</p></td>
    <td><input type="text" name="input_verifycode" id="input_verifycode" maxlength=4
            placeholder="Enter code here" autocomplete="off" class="inputbox" required></td>
</tr>
<tr>
    <td class="table-right-align"><p></p></td>
    <td><img style="cursor: pointer;"
            title="click to change"
            id="refresh" border="0"
            src="imgverify.php?"
            onclick="document.getElementById('refresh').src='imgverify.php?t='+Math.random()">
    </td>
</tr>
<tr>
    <td><br/></td>
</tr>