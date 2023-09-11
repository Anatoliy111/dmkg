<?php


use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */

  $asset = \app\assets\AppAsset::register($this);

?>


<!--    col-lg-offset-2-->
<?php

$session = Yii::$app->session;

//if (array_key_exists('modalmess', $session)) {
if (isset($_SESSION['modalmess']))  {

    if (array_key_exists('errtokenpass', $session['modalmess'])) {
        $modalformheader='Помилка';
        $modalformtext='Вибачте, але ваше посилання з листа вже не дійсне!!! Пройдіть процедуру відновлення паролю заново.';
        $modalformimage='nothyperlink.png';
    }

    if (array_key_exists('sessionclose', $session['modalmess'])) {
        $modalformheader='Помилка';
        $modalformtext='Вибачте, але ваша сессія скінчилась. Виконайте вхід заново!!!';
        $modalformimage='nothyperlink.png';
    }

    if (array_key_exists('errtokenauth', $session['modalmess'])) {
        $modalformheader='Помилка';
        $modalformtext='Вибачте, але ваше посилання з листа вже не дійсне!!! Пройдіть процедуру реєстрації заново.';
        $modalformimage='nothyperlink.png';
    }

    if (array_key_exists('errtokenchemail', $session['modalmess'])) {
        $modalformheader='Помилка';
        $modalformtext='Вибачте, але ваше посилання з листа вже не дійсне!!! Пройдіть процедуру зміни ел.пошти заново.';
        $modalformimage='nothyperlink.png';
    }

    if (array_key_exists('erremail', $session['modalmess'])) {
        $modalformheader='Помилка';
        $modalformtext='Вибачте, але абонент з такою ел.поштою '.$session['modalmess']['erremail']->email.' вже зареєстровано!!!';
        $modalformimage='nothyperlink.png';
    }

    if (array_key_exists('updpass', $session['modalmess'])) {
        $modalformheader='Відновлення паролю';
        $modalformtext='Вітаємо '.$session['modalmess']['updpass']->fio.', ваш пароль змінено!';
        $modalformimage='password.png';

    }

    if (array_key_exists('changeemailsuccess', $session['modalmess'])) {
        $modalformheader='Зміна пошти';
        $modalformtext='Вітаємо '.$session['modalmess']['changeemailsuccess']->fio.', ваша пошта змінена!';
        $modalformimage='email.png';

    }

    if (array_key_exists('addabon', $session['modalmess'])) {
        $modalformheader='Успішна реєстрація';
        $modalformtext='Вітаємо '.$session['modalmess']['addabon']->fio.', вас зареєстровано в системі! Виконайте вхід за допомогою вашого логіну(email) та паролю!';
        $modalformimage='registration.png';

    }

    if (array_key_exists('emailfog', $session['modalmess'])) {
        $modalformheader='Відновлення паролю';
        $modalformtext='На вашу пошту '.$session['modalmess']['emailfog']->email.' відправлено лист з посиланням для підтвердження зміни паролю. Для підтвердження перейдіть (натисніть) на це посилання з листа!!!';
        $modalformimage='email.png';
    }

    if (array_key_exists('emailchange', $session['modalmess'])) {
        $modalformheader='Зміна пошти';
        $modalformtext='На вашу пошту '.$session['modalmess']['emailchange']->email.' відправлено лист з посиланням для підтвердження зміни пошти. Для підтвердження перейдіть (натисніть) на це посилання з листа!!!';
        $modalformimage='email.png';
    }

    if (array_key_exists('emailauth', $session['modalmess'])) {
        $modalformheader='Реєстрація';
        $modalformtext='На вашу пошту '.$session['modalmess']['emailauth']->email.' відправлено лист з посиланням для підтвердження реєстрації. Для підтвердження перейдіть (натисніть) на це посилання з листа!!!';
        $modalformimage='email.png';
    }

    if (array_key_exists('addpokazn', $session['modalmess'])) {
        $modalformheader='Холодна вода';
        $modalformtext='Вітаємо '.$session['model']->fio.', ваш показник лічильника холодної води по рахунку '.trim(iconv('windows-1251', 'UTF-8', $_SESSION['abon']->schet)).' становить '.'<h2 style="color:#b92c28">'.$session['modalmess']['addpokazn'].'</h2>';
        $modalformimage='registration.png';
    }

    if (array_key_exists('kub', $session['modalmess'])) {
        $modalformtext=$modalformtext.'<h3 style="line-height: 1.5;">'.' Вам нараховано в цьому місяці '.$session['modalmess']['kub'].' кубометрів води!'.'</h3>';
    }

    if (array_key_exists('addpokazn2', $session['modalmess'])) {
        $modalformheader='Холодна вода';
        $modalformtext='Вітаємо '.$session['model']->fio.', ваш показник лічильника холодної води '.'<h2 style="color:#b92c28">'.$session['modalmess']['addpokazn2'].'</h2>'.'<h3 style="line-height: 1.5;">'.' по рахунку '.trim(iconv('windows-1251', 'UTF-8', $_SESSION['abon']->schet)).' прийнято в обробку! Наразі відбувається закриття звітного періоду, яке триває від 3-х до 6-ти днів від початку місяця, після чого ваш показник буде оброблено'.'</h3>';
        $modalformimage='registration.png';
    }

    $session->remove('modalmess');

Modal::begin([

    'header' => '<h2>'.$modalformheader.'</h2>',
//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
    'id' => 'modalmess1',
    'size' => 'modal-md',
    'headerOptions' => [
        'style' => 'text-align: center;'
    ],

]);
?>

<div class="modal-email">

    <img itemprop="image" src="<?= $asset->baseUrl.'/'.$modalformimage ?>" alt="EMAIL">

    <?php
    echo '<h3 style="line-height: 1.5;">'.$modalformtext.'</h3>';
    ?>
</div>


<?php Modal::end();
}
?>
















