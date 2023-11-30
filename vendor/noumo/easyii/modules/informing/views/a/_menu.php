<?php
use yii\helpers\Url;
use yii\helpers\Html;

$action = $this->context->action->id;
$module = $this->context->module->id;
?>
<ul class="nav nav-pills">
    <li <?= ($action === 'index') ? 'class="active"' : '' ?>>
        <a href="<?= $this->context->getReturnUrl(['/admin/'.$module]) ?>">
            <?php if($action == 'edit' || $action == 'photos') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
            <?= Yii::t('easyii', 'List') ?>
        </a>
    </li>
    <?php
    if ($action === 'index') {
    ?>
    <li <?= ($action === 'create') ? 'class="active"' : '' ?>><a href="<?= Url::to(['/admin/'.$module.'/a/create']) ?>"><?= Yii::t('easyii', 'Create') ?></a></li>
    <li><a href="<?= Url::to(['/admin/'.$module.'/a/sendmess']) ?>">Відправити останнє оголошення на ViberBot та Email</a></li>
    <?php } ?>
</ul>
<?php
if ($action === 'index') {
?>
<div class="dropdown_day" style="margin: 10px;">
    <?= Html::dropDownList('', \yii\easyii\models\Setting::get('visible_informing'),[range(0, 30)][0],[
            'empty' => 'Виберіть кількість днів',
            'id' => 'dropday',
            'onchange' => "
                    var selectedValue = $(this).val();
//                    alert(selectedValue);
                    $.ajax({
                        url: '/admin/informing/a/visibleday', // Замініть шлях на ваш контролер та дію
                        method: 'post',
                        data: { day: selectedValue },
                        success: function(response) {
                            // Обробте відповідь від сервера, якщо потрібно
                            console.log('Server response:', response);
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });                    
                "
    ]) ?>
</div>

<div class="text_day" style="margin: 10px;">
    <p>Кількість днів відображення останнього оголошення на головній сторінці сайту, від дати створення оголошення.</p>
</div>
<?php } ?>

<br/>