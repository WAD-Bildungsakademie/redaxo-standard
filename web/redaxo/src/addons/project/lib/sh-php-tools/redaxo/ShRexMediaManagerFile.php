<?php

/**
 * Author: Stefan Haack (https://shaack.com)
 * License: MIT
 */
class ShRexMediaManagerFile
{

    private string $fileName;
    private rex_media $media;

    private bool $isPlaceholder = false;

    public function __construct(string $fileName = null)
    {
        if (!$fileName) {
            $this->fileName = ShRexMetaInfos::getValue("placeholderImage");
            $this->isPlaceholder = true;
        } else {
            $this->fileName = $fileName;
        }
        $media = rex_media::get($this->fileName);
        if (!$media) {
            $this->fileName = ShRexMetaInfos::getValue("placeholderImage");
            $media = rex_media::get($this->fileName);
            $this->isPlaceholder = true;
        }
        $this->media = $media;
    }

    function getMedia(): rex_media
    {
        return $this->media;
    }

    function getTitle(): string
    {
        return $this->media->getTitle();
    }

    function getImageSrc($type = "default"): string
    {
        return "/index.php?rex_media_type={$type}&rex_media_file={$this->fileName}";
    }

    function getFileUrl(): string
    {
        return "/media/{$this->fileName}";
    }

    function getFileName(): string
    {
        return $this->fileName;
    }

    public static function getFileNameByTitle(string $title, int $parentId = 0): ?string
    {
        $sql = rex_sql::factory();
        $media = $sql->getArray('SELECT filename FROM ' . rex::getTable('media') . ' WHERE title = :title AND category_id = :parent_id LIMIT 1', [
            ':title' => $title,
            ':parent_id' => $parentId
        ]);
        return $media[0]['filename'] ?? null;
    }


    function isPlaceholder(): bool
    {
        return $this->isPlaceholder;
    }

    public function getMetaInfo(string $string): int|string|null
    {
        return $this->media->getValue($string);
    }

    public function getFormattedSize(): string
    {
        $size = $this->media->getSize();
        if ($size > 1024 * 1024) {
            return number_format($size / 1024 / 1024, 2, ",", ".") . " MB";
        } else {
            return number_format($size / 1024, 2, ",", ".") . " KB";
        }
    }

    public function getRatio(): float
    {
        if ($this->media->getWidth() == 0 || $this->media->getHeight() == 0) {
            error_log("MediaManagerFile: getRatio: width or height is 0");
            return 1;
        } else {
            return $this->media->getWidth() / $this->media->getHeight();
        }
    }

    function mediaBelongsToCurrentDomain(string $filename): bool
    {
        $currentHost = rex_yrewrite::getCurrentDomain() ?: '';
        $domainToCategoryId = [
            'example-a.tld' => 10, // category id for Site A
            'example-b.tld' => 20, // category id for Site B
        ];

        $catIdAllowed = $domainToCategoryId[$currentHost] ?? null;
        if (!$catIdAllowed) {
            return false;
        }

        $sql = rex_sql::factory();
        $sql->setQuery('SELECT category_id FROM ' . rex::getTable('media') . ' WHERE filename = :f LIMIT 1', [':f' => $filename]);
        if (!$sql->getRows()) {
            return false;
        }

        return (int) $sql->getValue('category_id') === (int) $catIdAllowed;
    }


}
