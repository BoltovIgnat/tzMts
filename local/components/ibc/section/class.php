<?php
namespace Ibc\Tz;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main;
use Bitrix\Main\Context;
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;
use Bitrix\Main\Loader;

Class Component extends \CBitrixComponent{

    public function onPrepareComponentParams($arParams){
        $result = parent::onPrepareComponentParams($arParams);
        return $result;
    }

    public function executeComponent(){
        if($this->startResultCache(false))
        {
            \Bitrix\Main\Loader::includeModule('iblock');


            $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
            $uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());
            $path = $uri->getPath();
            $pieces = explode("/", $path);
            //print_r(count($pieces));
            if (count($pieces) == 3){
                $page = 'list';
                $this->arResult = $this->getResult(1);

            }elseif(count($pieces) == 4){

            }elseif(count($pieces) == 5){
                $page = 'element';
                $this->arResult = $this->getResultByCode($pieces[3]);
            }


            $this->includeComponentTemplate($page);
        }
    }

    private function getResult($iNumPage){
        $result = array();
        
        \Bitrix\Main\Loader::includeModule('iblock');
        \Bitrix\Main\Loader::includeModule('highloadblock');
        \Bitrix\Main\Loader::includeModule("ibc.tz");

        $query = new \Bitrix\Main\Entity\Query(EmployeeTable::getEntity());

        $query
            ->registerRuntimeField("Position", array(
                    "data_type" => "Ibc\Tz\PositionTable",
                    'reference' => array('=this.ID_POSITION' => 'ref.ID'),
                    'join_type' => "LEFT"
                )
            )
            //->setFilter(array())
            ->setSelect(array("*","Position"));

        $qresult = $query->exec();

        while($ar=$qresult->fetch())
        {
            $result['ITEMS'][] = $ar;
        }

        return $result;
    }

    private function getResultByCode($code){
        $result = array();
        \Bitrix\Main\Loader::includeModule('iblock');
        $arLikeArticles = $this->getLikeByUser();
        $arSelect = Array(
            "ID",
            "IBLOCK_ID", "LANG_ID",
            "CODE",
            "NAME",
            "PREVIEW_TEXT",
            "DETAIL_TEXT",
            "DETAIL_PAGE_URL",
            "DATE_ACTIVE_FROM",
            'PREVIEW_PICTURE',
            'DETAIL_PICTURE',
            "PROPERTY_*"
        );
        $FILTER = Array(
            "IBLOCK_ID"=> 39,
            "CODE" => $code,
            "ACTIVE"=>"Y"
        );

        $selectModule = \CIBlockElement::getList(
            ['SORT'=>'ASC'],
            $FILTER,
            false,
            [],
            $arSelect);

        while ($resultType = $selectModule->fetch()) {
            $result['ITEM'] = $resultType;
            $result['ITEM']["PREVIEW_PICTURE"] = \CFile::GetPath($resultType["PREVIEW_PICTURE"]);
            $result['ITEM']["DETAIL_PICTURE"] = \CFile::GetPath($resultType["DETAIL_PICTURE"]);

        }

        return $result;
    }

    public function sendMessage($post){
        $iNumPage = $post['numPage'];
        $result = array();
        \Bitrix\Main\Loader::includeModule('iblock');
        
        $arLikeArticles = $this->getLikeByUser();

        $arSelect = Array(
            "ID",
            "IBLOCK_ID", "LANG_ID",
            "CODE",
            "NAME",
            "PREVIEW_TEXT",
            "DETAIL_PAGE_URL",
            "DATE_ACTIVE_FROM",
            'PREVIEW_PICTURE',
            'DETAIL_PICTURE',
            "PROPERTY_*"
        );
        $FILTER = Array(
            "IBLOCK_ID"=> 39,
            "ACTIVE"=>"Y"
        );

        $arNavStartParams = [
            'iNumPage' => $iNumPage,
            'nPageSize' => 12,
        ];

        $selectModule = \CIBlockElement::getList(
            ['SORT'=>'ASC'],
            $FILTER,
            false,
            $arNavStartParams,
            $arSelect);

        while ($resultType = $selectModule->fetch()) {
            $result['ITEMS'][$resultType['ID']] = $resultType;
            $result['ITEMS'][$resultType['ID']]["PREVIEW_PICTURE"] = \CFile::GetPath($resultType["PREVIEW_PICTURE"]);
            if(empty($resultType['CODE'])){
                $result['ITEMS'][$resultType['ID']]['URL'] = '#';
            }else{
                $result['ITEMS'][$resultType['ID']]['URL'] =  '/blog/article/'.$resultType['CODE'].'/';
            }
            $VALUES = array();
            $res = \CIBlockElement::GetProperty(39, $resultType['ID'], "sort", "asc", array("CODE" => "TAG"));
            while ($ob = $res->GetNext())
            {
                $VALUES[] = $ob['VALUE'];
            }
            $result['ITEMS'][$resultType['ID']]['TAGS'] = $VALUES;
            if(!empty( $arLikeArticles[$resultType['ID']])){
                $result['ITEMS'][$resultType['ID']]['LIKED'] = 1;
            }else{
                $result['ITEMS'][$resultType['ID']]['LIKED'] = 0;
            }
        }

        $result['COUNT_ELEM'] = \CIBlockElement::GetList(
                array(),
                array('IBLOCK_ID' => 39),
                array(),
                false,
                array('ID', 'NAME')
            );

        $result['COUNT_PAGE'] = ceil($result['COUNT_ELEM'] / 12);
        $result['ACTIVE_PAGE'] = $iNumPage;

        return $result;
    }


}
