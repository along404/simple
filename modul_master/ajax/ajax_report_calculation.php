<?php
include_once '../../connection/db_config.php';
include_once '../../includes/function.php';

$db = db_connect();

$dateFrom = DateToDb(filter_input(INPUT_GET, 'date_from'));
$dateTo = DateToDb(filter_input(INPUT_GET, 'date_to'));
$dateOpening = filter_input(INPUT_GET, 'opening_balance');

$qCurrency = "SELECT * FROM sypd_parameter_detail WHERE sypd_sypm_id = 1";
$resCurrency = $db->query($qCurrency);

//echo intervalReturn($dateOpening, 86.94);
?>
<body>
    Table 1 : Interval values 

    <table border='1' width='30%' style="border-collapse: collapse">
        <tr>
            <?php while ($rowCurrency = $resCurrency->fetch_assoc()) { ?>
                <td style="text-align: center"><?php echo $rowCurrency['sypd_code'] ?></td>
            <?php } ?>
        </tr>
    </table>

    <br>
    <br>
    <br>

    Table 2 : Interval Return


</body>

