<?php
    use app\modules\reports\models\ReportOnMoney as R;

    /* @var $reportList \app\modules\reports\models\ReportOnMoney[] */
?>

<div class="view-report-on-money">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Месяц</th>
            <th>Сумма</th>
            <th>Комментарий</th>
        </tr>
        </thead>
        <tbody>
        <? $i = 0;
            foreach ($reportList as $report): ?>
                <tr>
                    <td><?= ++$i; ?></td>
                    <td><?= R::getMonth()[ $report->month ] ?></td>
                    <td><?= $report->sum ?> руб.</td>
                    <td><?= $report->comment ?></td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
</div>
