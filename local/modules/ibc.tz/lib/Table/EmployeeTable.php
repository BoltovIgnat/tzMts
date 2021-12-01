<?php
namespace ibc\Tz;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\DatetimeField,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

/**
 * Class EmployeeTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> TITLE string(255) mandatory
 * <li> YEAR datetime mandatory
 * <li> COPIES_CNT int mandatory
 * </ul>
 *
 * @package Bitrix\Book
 **/

class EmployeeTable extends Entity\DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'ibc_employee';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            new Entity\IntegerField(
                'ID',
                [
                    'primary' => true,
                    'autocomplete' => true,
                    'column_name' => 'ID'
                ]
            ),
            new Entity\StringField(
                'NAME',
                [
                    'column_name' => 'NAME'
                ]
            ),
            new Entity\DateField(
                'DATE_RECEPT',
                [
                    'column_name' => 'DATE_RECEPT'
                ]
            ),
            new Entity\IntegerField(
                'ID_POSITION',
                [
                    'column_name' => 'ID_POSITION'
                ]
            ),
        ];
    }
}