<?php
namespace ibc\Tz;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

/**
 * Class PositionTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> FIRST_NAME string(255) mandatory
 * <li> LAST_NAME string(255) mandatory
 * <li> SECOND_NAME string(255) mandatory
 * <li> CITY string(255) mandatory
 * </ul>
 *
 * @package Bitrix\Author
 **/

class PositionTable extends Entity\DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'ibc_position';
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
            new Entity\StringField(
                'TITLE',
                [
                    'column_name' => 'TITLE'
                ]
            ),
        ];
    }
}
?>