<html lang="en">
<head>
    <title>Добавление заведения</title>
</head>
<body>
<table>
    <tr>
        <td>
            <?php
            print $request->getFeedbackString("</td></tr><tr><td>")
            ?>
        </td>
    </tr>
</table>
<form action="/addvenue.php" method="get">
    <input type="hidden" name="submitted" value="yes">
    <input type="text" name="venue_name">
    <button type="submit">Отправить</button>
</form>
</body>
</html>