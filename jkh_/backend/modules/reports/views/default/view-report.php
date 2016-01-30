<?php
    /* @var $reportList array */
    /* @var $workTypes array */
?>

<div class="view-report">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Вид работ</th>
            <th>Общая сумма</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0;
            foreach ($reportList as $report): ?>
                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= $workTypes[ $report['work_type'] ] ?></td>
                    <td><?= $report['sum'] ?></td>
                    <td><a href="<?= \yii\helpers\Url::to(["default/view-all-info-of-report", "id"=>$report['work_type']])?>" class="btn btn-link">Подробнее</a></td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
</div>
