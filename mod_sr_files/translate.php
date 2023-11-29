<?php

class T {
    private static mixed $translation_data;
    private static mixed $fallback_data;

    private static string $TRANSLATION_PATH = "https://app.swimresults.de/assets/i18n/";

    public static function init($lang): void
    {
        $translation_file1 = file_get_contents(self::$TRANSLATION_PATH."de.json");
        self::$fallback_data = json_decode($translation_file1, TRUE);
        self::$translation_data = self::$fallback_data;
        $translation_file = file_get_contents(self::$TRANSLATION_PATH.$lang.".json");
        if ($translation_file) {
            self::$translation_data = json_decode($translation_file, TRUE);
        }

    }

    public static function t($key): string {
        $key_split = explode(".", $key);
        $data = self::$translation_data;
        foreach ($key_split as $split) {
            if (!array_key_exists($split, $data)) {
                $data = FALSE;
                break;
            }
            $data = $data[$split];
        }
        if ($data) return $data;

        $data = self::$fallback_data;
        foreach ($key_split as $split) {
            if (!array_key_exists($split, $data)) {
                $data = FALSE;
                break;
            }
            $data = $data[$split];
        }
        if ($data) return $data;

        return $key;
    }

    public static function e($key): void {
        echo(self::t($key));
    }

    public function __toString() {
        return "";
    }

}

