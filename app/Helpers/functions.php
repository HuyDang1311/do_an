<?php

if (!function_exists('transArr')) {

    /**
     * Translate with array
     *
     * @param array $data   Data format
     * @param array $locale Locale
     * @param bool  $isFlip Check use flip array
     *
     * @return array
     */
    function transArr(array $data, $locale = null, bool $isFlip = false)
    {
        $locales = explode(",", $locale);
        $arr = [];

        foreach ($data as $key => $value) {
            foreach ($locales as $locale) {
                if ($isFlip) {
                    $arr[trans($value, [], 'messages', $locale)] = $key;
                } else {
                    $arr[$key] = trans($value, [], 'messages', $locale);
                }
            }
        }

        return $arr;
    }
}

if (!function_exists('toPgArray')) {

    /**
     * Convert to array postgres
     *
     * @param array $data Data
     *
     * @return bool
     */
    function toPgArray(array $data)
    {
        $result = [];
        foreach ($data as $value) {
            if (is_array($value)) {
                $result[] = toPgArray($value);
            } else {
                $value = str_replace('"', '\\"', $value);
                if (!is_numeric($value)) {
                    $value = '"' . $value . '"';
                }
                $result[] = $value;
            }
        }

        return '{' . implode(",", $result) . '}';
    }
}

if (!function_exists('getCurrentUserLogin')) {

    /**
     * Get Current User Login
     *
     * @param array $fields Fields
     *
     * @return \App\Models\User
     */
    function getCurrentUserLogin($fields = ['*'])
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        return $user->setVisible(array_merge($user->getVisible(), $fields));
    }
}

if (!function_exists('getSortConditions')) {

    /**
     * Get sort condition
     *
     * @param array  $data              Data
     * @param array  $sortColumns       Sort Columns
     * @param string $sortColumnDefault Sort column Default
     *
     * @return array
     */
    function getSortConditions(array $data = [], array $sortColumns = [], string $sortColumnDefault = 'id')
    {
        $sortDirections = ['desc', 'asc'];
        if (!isset($data['sort_column']) || !in_array($data['sort_column'], $sortColumns)) {
            $data['sort_column'] = isset($sortColumns[$data['sort_column']]) ? $sortColumns[$data['sort_column']]
                : $sortColumnDefault;
        }

        if (!in_array($data['sort_direction'], $sortDirections)) {
            $data['sort_direction'] = 'desc';
        }

        return $data;
    }
}
