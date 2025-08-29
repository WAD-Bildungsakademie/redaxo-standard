<?php
class ShRexMetaInfos {
    private static ?FriendsOfRedaxo\YrewriteMetainfo\Domain $cachedMetaInfos = null;

    static function getValue($name)
    {
        if (self::$cachedMetaInfos === null) {
            self::$cachedMetaInfos = FriendsOfRedaxo\YrewriteMetainfo\Domain::getCurrent();
        }
        return self::$cachedMetaInfos->getValue($name);
    }
}