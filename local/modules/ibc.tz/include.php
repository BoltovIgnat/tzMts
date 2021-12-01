<?php
$arClasses = [
    '\Ibc\Tz\PositionTable' => 'lib/Table/PositionTable.php',
    '\Ibc\Tz\EmployeeTable' => 'lib/Table/EmployeeTable.php',

//    '\Ibc\Znp\Visit' => 'lib/Orm/Visit.php',
//    '\Ibc\Znp\Company' => 'lib/Orm//Company.php',
];

\Bitrix\Main\Loader::registerAutoLoadClasses('ibc.tz', $arClasses);