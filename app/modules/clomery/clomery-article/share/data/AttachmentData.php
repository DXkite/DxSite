<?php
namespace clomery\article\data;

use JsonSerializable;
use suda\application\database\DataObject;
use suda\orm\struct\TableStruct;
use suda\orm\struct\TableStructCreateInterface;
use support\openmethod\RequestInputTrait;
use support\openmethod\MethodParameterInterface;


/**
 * @table attachment
 * @field id bigint(20) primary unsigned auto
 * @field name varchar(255) comment("附件名")
 * @field path varchar(255) comment("文件路径")
 * @field hash varchar(32) key comment("文件HASH")
 * @field ip varchar(32) comment("文件IP")
 * @field time int(11) comment("创建时间")
 */
class AttachmentData  extends DataObject implements MethodParameterInterface, JsonSerializable, TableStructCreateInterface
{
    use RequestInputTrait;

    /**
     * 创建数据表结构
     *
     * @param TableStruct $struct 父级或初始数据表结构
     * @return TableStruct
     */
    public static function createTableStruct(TableStruct $struct): TableStruct
    {
        $struct->setName('attachment');

        return $struct;
    }
}