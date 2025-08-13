<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShRexArticleService
{

    static function getPrivacyPolicyArticle()
    {
        /** @var $domain rex_yrewrite_domain */
        $domain = rex_yrewrite::getCurrentDomain();
        $article = self::getArticleByName("Datenschutz", $domain->getMountId());
        if (!$article) {
            $article = self::getArticleByName("Datenschutzerklärung", $domain->getMountId());
        }
        return $article;
    }

    static function getLegalNoticeArticle()
    {
        /** @var $domain rex_yrewrite_domain */
        $domain = rex_yrewrite::getCurrentDomain();
        $article = self::getArticleByName("Impressum", $domain->getMountId());
        return $article;
    }

    /**
     * Find an online article by its (exact) name.
     *
     * @param string $name Article name to match (per language)
     * @param int|null $parentId Optional: limit search to this category (parent_id)
     * @param int|null $clangId Optional: language; defaults to current language
     *
     * @return rex_article|null
     */
    static function getArticleByName(string $name, ?int $parentId = null, ?int $clangId = null): ?rex_article
    {
        $clangId ??= rex_clang::getCurrentId();
        $params = [
            ':name' => $name,
            ':clang' => $clangId,
        ];
        $where = 'name = :name AND clang_id = :clang AND status = 1';
        if ($parentId !== null) {
            $where .= ' AND parent_id = :parent';
            $params[':parent'] = $parentId;
        }
        $sql = rex_sql::factory();
        $sql->setQuery(
            'SELECT id FROM ' . rex::getTable('article') . ' WHERE ' . $where . ' ORDER BY startarticle DESC, priority ASC LIMIT 1',
            $params
        );
        if ($sql->getRows() === 0) {
            return null;
        }
        return rex_article::get((int)$sql->getValue('id'), $clangId);
    }
}