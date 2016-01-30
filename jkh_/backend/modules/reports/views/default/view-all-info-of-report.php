<?php
    /* @var $reportList \app\modules\reports\models\Report[] */
    /* @var $workType string */
?>

<div class="view-report">
    <?= $workType ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Дата</th>
            <th>Сумма</th>
            <th>Комментарий</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0;
            foreach ($reportList as $report): ?>
                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= $report->date ?></td>
                    <td><?= $report->sum ?></td>
                    <td><?= $report->comment ?></td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>

    <h1 align="center"><a href="<?= \yii\helpers\Url::to(['default/view-reports'])?>" class="btn btn-lg btn-primary">Назад</a></h1>
</div>
