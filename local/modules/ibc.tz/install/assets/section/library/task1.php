<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Библиотека");

use Bitrix\Main\Loader;

Loader::includeModule("ibc.tz");

use Ibc\library\AuthorTable;
use Ibc\library\BookTable;
use Ibc\library\PublisherTable;
use Ibc\library\GapTable;


    $query = new \Bitrix\Main\Entity\Query(BookTable::getEntity());

    $query
    ->registerRuntimeField("publisher", array(
            "data_type" => "Ibc\library\PublisherTable",
            'reference' => array('=this.PUBLISHER_ID' => 'ref.ID'),
            'join_type' => "LEFT"
        )
    )
    ->registerRuntimeField("gap", array(
        "data_type" => "Ibc\library\GapTable",
        'reference' => array('=this.ID' => 'ref.BOOK_ID'),
        'join_type' => "LEFT"
    ))
    ->registerRuntimeField("author", array(
        "data_type" => "Ibc\library\AuthorTable",
        'reference' => array('=this.gap.AUTHOR_ID' => 'ref.ID'),
        'join_type' => "LEFT"
    ))
   ->registerRuntimeField("cnt", array(
            "data_type" => "integer",
            "expression" => array("count(%s)", "TITLE")
        )
    )
    ->setFilter(array("publisher.TITLE" =>"publisher1", "author.LAST_NAME" =>"author 2"))
    ->setSelect(array("cnt"));

    $result = $query->exec();

    while($ar=$result->fetch())
    {

        echo '<pre>';
        print_r($ar);
        echo '</pre>';

    }


?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>