<?php

namespace App\Factories;

use App\Constants\Keywords;

class QuestionFactory
{
    protected $words;

    const MAX_WORDS = 107551;

    /**
     * construct
     */
    private function __construct()
    {
        $this->words();
    }

    /**
     * Words
     */
    private function words()
    {
        $this->words = include_once(base_path("words.php"));
    }

    /**
     * Spit Random Word
     * @return string
     */
    protected function spitWord(int $index)
    {
        return $this->words[$index];
    }

    /**
     * Spit Index
     * @return int
     */
    protected function spitIndex()
    {
        return mt_rand(0, self::MAX_WORDS);
    }

    /**
     * Spit Random Words
     * @return array
     */
    protected function spitWords(int $numberOfWordsToSpit)
    {
        foreach (range(1, $numberOfWordsToSpit) as $index) {
            $words[] = $this->spitWord($this->spitIndex());
        }
        return count($words) > 1 ? $words : $words[0];
    }

    /**
     * Make factory
     */
    public static function make()
    {
        $self = new static();
        return $self;
    }

    /**
     * Generate
     */
    public function generate()
    {
        do {
            $answerable = $this->spitWords(1);
        } while ($this->invalidAnswer($answerable));

        $lengthOfCharactersToRemoveFromQuestions = strlen($answerable);
        $questions = $this->spitWords($lengthOfCharactersToRemoveFromQuestions);

        foreach (range(0, $lengthOfCharactersToRemoveFromQuestions - 1) as $answerableIndex) {
            $stripedQuestion[] = $this->stripCharFromQuestion(
                $questions[$answerableIndex], 
                $answerable, $answerableIndex
            );
        }

        return compact('stripedQuestion', 'answerable');
    }

    /**
     * Determine if a string ends with value
     */
    protected function endsWith($haystack, $needle)
    {
        if (($length = strlen($needle)) == 0) {
            return true;
        }
        return (substr($haystack, -$length) === $needle);
    }

    /**
     * Strip character from question
     * @param string $question
     * @param string $answer
     * @param int $index
     */
    protected function stripCharFromQuestion($question, $answer, $index)
    {
        $removeFromQuestion = strpos($question, $answer[$index]);
            if ($removeFromQuestion === false) {
                return $this->stripCharFromQuestion($this->spitWords(1), $answer, $index);
            }
        return substr_replace($question, "_", $removeFromQuestion, 1);
    }

    /**
     * Checks if answer fails any condition and regenerate new answer
     * @param string $answer
     * @return bool
     */
    protected function invalidAnswer($answerable)
    {
        if ( strlen($answerable) < 6)
            return $this->suspectsPlural($answerable);
        return true;
    }

    /**
     * Suspects plural
     */
    protected function suspectsPlural($answerable)
    {
        if (! $this->endsWith($answerable, "s"))
            return $this->isKeyWord($answerable);
        return true;
    }

    /**
     * Is Keyword
     */
    protected function isKeyWord($answerable)
    {
        return in_array($answerable, $this->keywords());
    }

    /**
     * Get Key Words
     * @return array
     */
    protected function keywords()
    {
        $keywordClass = new \ReflectionClass(Keywords::class);
        return array_values($keywordClass->getConstants());
    }


}