<?php
namespace clomery\content\table;

use suda\application\database\Table;
use suda\database\struct\TableStruct;

class FileTable extends Table {
    /**
     * 构建数据表
     * @param TableStruct $table
     * @return TableStruct
     */
    public function onCreateStruct(TableStruct $table): TableStruct
    {
        return $table->fields([
            $table->field('id', 'bigint', 20)->primary()->unsigned()->auto(),
            $table->field('name', 'varchar', 255)->comment('附件名'),
            $table->field('original_name', 'varchar', 255)->comment('原始文件名'),
            $table->field('password', 'varchar', 32)->default(null)->comment('提取码'),
            $table->field('uri', 'varchar', 255)->comment('附件URI'),
            $table->field('user', 'int', 20)->key()->comment('创建用户'),
            $table->field('time', 'int', 11)->comment('创建时间'),
            $table->field('hash', 'varchar', 32)->key()->comment('文件HASH'),
        ]);
    }
}