<?php
$key = 1; ?>
<div class="header-block">
    <h1 class="header-block-title">Блог</h1>
</div>
<div class="breadcrumbs"><a href="/" class="breadcrumbs__link">Главная страница</a>
    <span class="breadcrumbs__separator">→</span><span class="breadcrumbs__link">Блог</span>
</div>

<div class="header-block-search">
    <form class="search_blog" method="get" action="/blog/">
        <input class="ibc_search_input" type="text" placeholder="Поиск по блогу" name="search">
        <button class="ibc_search_btn" type="submit">Найти</button>
    </form>
</div>



<div class="header-block-inform-mobile inform-display">
    <div class="about-inform-wrap-mobile">
        <h3 class="about-inform-mobile">Категории статей</h3>
    </div>
    <div class="about-inform-btn-mobile">
        <a href="#"><img class="mw-100" src="src/img/arrow.svg" alt=""></a>
    </div>
</div>

<div class="main-page">

    <div class="main-page-block">
        <? $i = 0;
        foreach ($arResult['ITEMS'] as $key => $arItem){
        ?>
        <div class="main-page-block-wrap
            <? if ($i == 1 or $i == 4 or $i == 8 or $i == 11) { ?>medium<? } ?>
            <? if ($i == 2 or $i == 3 or $i == 5 or $i == 7 or $i == 6 or $i == 9 or $i == 10) { ?>small-page<? } ?>">


            <div class="about-wrap-img about-wrap-img-position about-wrap-img-margin" style="background: url(<?= $arItem['PREVIEW_PICTURE'] ?>);">
                <div class="ibc-tags">
                    <?foreach($arItem["TAGS"] as $arTag):?>
                        <?if (!empty($arTag)):?>
                            <div class="ibc-tag-value"><?=$arTag?></div>
                        <?endif;?>

                    <?endforeach;?>
                </div>
                <span class="about-span-img ibc-like-article <?=($arItem[LIKED]) ? "ibc-liked" : ""; ?>" ibc-data-like-id="<?=$arItem['ID']?>"></span>
            </div>
            <div class="about-wrap-page">
                <div class="about-wrap-title">
                    <h3 class="page-title"><?= $arItem[NAME] ;?></h3>
                </div>
                <div class="about-wrap-text">
                    <p class="page-text">
                        <?= $arItem[PREVIEW_TEXT] ?>
                    </p>
                </div>

                <div class="about-wrap-link">
                    <div class="about-link-wrap">
                        <a href="<?= $arItem['URL'] ?>">Подробнее</a>
                    </div>
                    <? $ardate = explode(' ', $arItem['DATE_ACTIVE_FROM']);
                    $arItem['DATE_ACTIVE_FROM'] = $ardate[0]; ?>
                    <div class="about-link-date">
                        <?= $arItem['DATE_ACTIVE_FROM'] ?>
                    </div>
                </div>
            </div>
        </div>
        <? $i++; } ?>

    </div>

    <div class="bx-pagination ">
        <div class="bx-pagination-container row">
            <ul>
                <li class="bx-pag-prev ibc-bx-pag-prev" ibc-data-pagination="current"><a href="#"><span>Назад</span></a></li>
                <?for ($i = 1; $i <= $arResult['COUNT_PAGE']; $i++) {
                    ?>
                    <li class=" <? if ($i == $arResult['ACTIVE_PAGE']) { ?>bx-active<? } ?> ibc-page" ibc-data-pagination="<?=$i?>">
                        <a href="#">
                            <span><?=$i?></span>
                        </a>
                    </li>
                <?}?>
                <li class="bx-pag-next ibc-bx-pag-next" ibc-data-pagination="next"><a href="/blog/"><span>Вперед</span></a></li>
            </ul>
            <div style="clear:both"></div>
        </div>
    </div>


</div>
</div>
