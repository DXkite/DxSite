<?php
class Storage_Driver_File implements Storage_Driver
{
    public static $charset=['GBK','GBK','GB2312','BIG5','GB13000','GB18030'];
    // 递归创建文件夹
    public static function mkdirs(string $dir, int $mode=0777)
    {
        if (!self::isDir($dir)) {
            if (!self::mkdirs(dirname($dir), $mode)) {
                return false;
            }
            if (!@mkdir($dir, $mode)) {
                return false;
            }
        }
        return true;
    }
    // 递归删除文件夹
    public static function rmdirs(string $dir)
    {
        if ($handle=opendir($dir)) {
            while (false!== ($item=readdir($handle))) {
                if ($item!="."&&$item!="..") {
                    if (self::isDir("$dir/$item")) {
                        self::rmdirs("$dir/$item");
                    } else {
                        unlink("$dir/$item");
                    }
                }
            }
        }
    }

    // 创建文件夹
    public static function mkdir(string $dirname, int $mode=0777)
    {
        return mkdir($path, $mode);
    }
    // 删除文件夹
    public static function rmdir(string $dirname)
    {
        return rmdir($path);
    }
    public static function put(string $name, $content)
    {
        return file_put_contents($name, $content);
    }

    public static function get(string $name)
    {
        return file_get_contents($name);
    }

    public static function remove(string $name)
    {
        return unlink($name);
    }
    public static function isFile(string $name)
    {
        return is_file($name);
    }
    public static function isDir(string $name)
    {
        return is_dir($name);
    }
    public static function isReadable(string $name)
    {
        return is_readable($name);
    }
    public static function size(string $name)
    {
        return filesize($name);
    }
    public static function type(string $name)
    {
        return filetype($name);
    }
    public static function exist(string $name, array $charset=[])
    {
        // UTF-8 格式文件路径
        if (self::exist_case($name)) {
            return true;
        }
        // Windows 文件中文编码
        static $charset=null;
        if (is_null($charset)) {
            $charset=array_merge(self::$charset, $charset);
        }
        foreach ($ch as $code) {
            $file = iconv('UTF-8', $code, $filename);
            if (self::exist_case($file)) {
                return $file;
            }
        }
        return false;
    }

    // 判断文件存在
    private function exist_case($name)
    {
        if (file_exists($name) && is_file($name) && $real=realpath($name)) {
            if (basename($real) === basename($name)) {
                return true;
            }
        }
        return false;
    }
}