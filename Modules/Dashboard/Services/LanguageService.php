<?php

namespace Modules\Dashboard\Services;


class LanguageService extends BaseService
{
    public function languagesArrayList(string $concrete = null): array
    {
        $arrayList = [];
        $languageList = \LaravelLocalization::getLocalesOrder();
        foreach ($languageList as $k=>$lang){
            if($concrete){
                $arrayList[$k] = $lang[$concrete];
            } else {
                $arrayList[$k] = $lang;
            }
        }
        return $arrayList;
    }

    public function languagesKeysList(): array
    {
        $languageList = \LaravelLocalization::getLocalesOrder();
        return array_keys($languageList);
    }

    public function getLanguageItemByLangKey(string $langKey): ?array
    {
        return config("laravellocalization.supportedLocales.{$langKey}");
    }

    public function getNativeLanguageByLangKey(string $langKey): string
    {
        $languageItem = $this->getLanguageItemByLangKey($langKey);
        return $languageItem['native'] ?? '';
    }
}
