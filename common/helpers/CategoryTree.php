<?php

namespace common\helpers;

use common\models\dvizh\Category;

class CategoryTree
{
    public static function build()
    {
        // Get all categories ordered
        $all = Category::find()
            ->orderBy(['sort' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        // Group by parent_id
        $grouped = [];
        foreach ($all as $cat) {
            $grouped[$cat->parent_id][] = $cat;
        }

        // Build full hierarchical tree
        return self::buildLevel(null, $grouped); // null = root categories
    }

    private static function buildLevel($parentId, &$grouped)
    {
        $result = [];

        if (!isset($grouped[$parentId])) {
            return $result;
        }

        foreach ($grouped[$parentId] as $model) {

            $result[] = [
                'model'  => $model,                                // <--- AR MODEL (translation ready)
                'id'     => $model->id,                            // keep id for URLs
                'childs' => self::buildLevel($model->id, $grouped) // recursively build children
            ];
        }

        return $result;
    }
}
