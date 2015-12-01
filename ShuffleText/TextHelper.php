<?php

class TextHelper
{
    const SEPARATOR           = '|';
    const START_CHOICE_BLOCK  = '{';
    const FINISH_CHOICE_BLOCK = '}';

    static function shuffleText($text)
    {

        $matches = array();
        $pattern = '/' . self::START_CHOICE_BLOCK . '[а-яa-z' . self::SEPARATOR . '\s]+' . self::FINISH_CHOICE_BLOCK . '/ui';

        if (preg_match_all($pattern, $text, $matches)) {
            $matches   = array_shift($matches);
            $trimItems = self::START_CHOICE_BLOCK . ',' . self::FINISH_CHOICE_BLOCK;

            foreach ($matches as $choiceItem) {
                $cleanedElement = trim($choiceItem, $trimItems);
                $choiceArray    = explode(self::SEPARATOR, $cleanedElement);
                $chosenWordKey  = rand(0, count($choiceArray) - 1);
                $text           = str_replace($choiceItem, $choiceArray[$chosenWordKey], $text);
            }
        }

        if (preg_match_all($pattern, $text, $matches)) {
            $text = self::shuffleText($text);
        }

        return $text;
    }
}

$someText = "
        {Пожалуйста|Просто} сделайте так, чтобы это {удивительное|крутое|простое} тестовое предложение {изменялось {быстро|мгновенно} случайным образом|менялось каждый раз}.
    ";

echo "\n\n";
print_r(TextHelper::shuffleText($someText));
echo "\n\n";