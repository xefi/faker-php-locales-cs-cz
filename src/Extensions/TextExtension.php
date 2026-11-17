<?php

namespace Xefi\Faker\CsCz\Extensions;

use Xefi\Faker\Extensions\TextExtension as BaseTextExtension;

class TextExtension extends BaseTextExtension
{
    /**
     * Text in format => Paragraphs => Sentences => Words.
     *
     * @var array|array[]
     */
    protected array $paragraphs = [
        [
            ['Kvalita', 'služeb', 'zůstává', 'hlavním', 'cílem', 'v', 'celém', 'profesním', 'odvětví.'],
            ['Každý', 'projekt', 'vyžaduje', 'pečlivé', 'plánování', 'a', 'jasné', 'rozdělení', 'odpovědnosti.'],
            ['Týmy', 'úzce', 'spolupracují', 'na', 'dosažení', 'společných', 'cílů.'],
            ['Otevřená', 'komunikace', 'mezi', 'kolegy', 'zvyšuje', 'produktivitu', 'i', 'vzájemnou', 'důvěru.'],
        ],
        [
            ['Správa', 'zdrojů', 'je', 'klíčovým', 'prvkem', 'celkové', 'výkonnosti.'],
            ['Pracovní', 'postupy', 'se', 'vyvíjejí', 'podle', 'potřeb', 'a', 'nových', 'technologií.'],
            ['Přizpůsobivost', 'pomáhá', 'firmám', 'zůstat', 'konkurenceschopné', 'a', 'inovativní.'],
            ['Procesy', 'se', 'pravidelně', 'revidují,', 'aby', 'se', 'zlepšily', 'výsledky', 'a', 'splnily', 'požadavky', 'trhu.'],
        ],
        [
            ['Spokojenost', 'zákazníků', 'závisí', 'na', 'kvalitě', 'služby', 'a', 'rychlosti', 'reakce.'],
            ['Ukazatele', 'slouží', 'k', 'měření', 'výkonu', 'a', 'usměrňují', 'strategická', 'rozhodnutí.'],
            ['Každodenní', 'výzvy', 'se', 'překonávají', 'díky', 'dobrému', 'řízení', 'a', 'odpovídajícím', 'dovednostem.'],
            ['Pravidelné', 'hodnocení', 'postupů', 'odhaluje', 'možnosti', 'dalšího', 'zlepšení.'],
        ],
        [
            ['Vzdělávání', 'a', 'rozvoj', 'dovedností', 'patří', 'mezi', 'priority', 'každé', 'firmy.'],
            ['Zaměstnanci', 'jsou', 'vedeni', 'k', 'osvojování', 'nových', 'znalostí', 'a', 'k', 'inovacím.'],
            ['Strategie', 'neustálého', 'zlepšování', 'zvyšují', 'výkon', 'a', 'snižují', 'rizika.'],
            ['Individuální', 'vzdělávací', 'programy', 'podporují', 'osobní', 'i', 'týmový', 'růst.'],
        ],
        [
            ['Analýza', 'dat', 'pomáhá', 'najít', 'oblasti', 'růstu', 'a', 'zlepšení.'],
            ['Cíle', 'se', 'upravují', 'podle', 'vývoje', 'trhu', 'a', 'očekávání', 'zákazníků.'],
            ['Průběžné', 'sledování', 'pokroku', 'umožňuje', 'rychle', 'reagovat', 'na', 'změny.'],
            ['Rozhodování', 'vychází', 'ze', 'spolehlivých', 'dat', 'a', 'přesných', 'analýz.'],
            ['Pravidelné', 'revize', 'umožňují', 'přehodnotit', 'strategii', 'a', 'zavést', 'nápravná', 'opatření.'],
        ],
    ];

    /**
     * Returns the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'cs_CZ';
    }
}
