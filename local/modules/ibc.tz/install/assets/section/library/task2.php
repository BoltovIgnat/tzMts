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
    ->setFilter(array("ID" =>"1"))
    ->setSelect(array("*", "author", "publisher"));

$result = $query->exec();

$countRow = $result->getSelectedRowsCount();

while($ar=$result->fetch())
{

    echo '<pre>';
    echo 'Гонорар автора '.$ar[IBC_LIBRARY_BOOK_author_FIRST_NAME].' составил: ';
    print_r(($ar['IBC_LIBRARY_BOOK_publisher_AUTHOR_PROFIT']/$countRow)*$ar['COPIES_CNT']);
    echo '</pre>';

}


?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>