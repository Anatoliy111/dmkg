<?php
use yii\easyii\modules\informing\models\Informing;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('easyii/informing', 'Informing');

$module = $this->context->module->id;
?>

<?= $this->render('_menu') ?>

<?php if($data->count > 0) : ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <?php if(IS_ROOT) : ?>
                    <th width="50">#</th>
                <?php endif; ?>
                <th><?= Yii::t('easyii', 'Title') ?></th>
                <th width="120"><?= Yii::t('easyii', 'Views') ?></th>
                <th width="100"><?= Yii::t('easyii', 'Status') ?></th>
                <th width="100"><?= Yii::t('easyii', 'Date') ?></th>
                <th width="120"></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($data->models as $item) : ?>
            <tr data-id="<?= $item->primaryKey ?>">
                <?php if(IS_ROOT) : ?>
                    <td><?= $item->primaryKey ?></td>
                <?php endif; ?>
                <td><a href="<?= Url::to(['/admin/'.$module.'/a/edit/', 'id' => $item->primaryKey]) ?>"><?= $item->title ?></a></td>
                <td><?= $item->views ?></td>
                <td class="status">
                    <?= Html::checkbox('', $item->status == Informing::STATUS_ON, [
                        'class' => 'switch',
                        'data-id' => $item->primaryKey,
                        'data-link' => Url::to(['/admin/'.$module.'/a']),
                    ]) ?>
                </td>
                <td><?= $item->date ?></td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="<?= Url::to(['/admin/'.$module.'/a/delete', 'id' => $item->primaryKey]) ?>" class="btn btn-default confirm-delete" title="<?= Yii::t('easyii', 'Delete item') ?>"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                </td>
            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <?= yii\widgets\LinkPager::widget([
        'pagination' => $data->pagination
    ]) ?>
<?php else : ?>
    <p><?= Yii::t('easyii', 'No records found') ?></p>
<?php endif; ?>