<?php

namespace App\Livewire;

use Livewire\Component;


class FindMistake extends Component
{
    public $timer = 60;
    public $timerReady = 3;
    public $isStarted = false;
    public $pageLoad = "waitstart";
    public $currentRound = 1;
    public $currentSentence = 0;
    public $currentData = [];
    public $state = "old";
    public $isLastOne = false;
    public $endSencene = false;
    public $data = [
        [
            "round" => 1,
            "author" => "Author Name",
            "sentences" => [
                [
                    "sentence" => 1,
                    "content" => "<p>She had been <span class='hint'>going</span> to that gym for over a year before she <span class='hint answer'>decides</span> to try a different one.</p>",
                    "mistake" => "decides",
                    "correction" => "decided",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The sentence is in the past perfect tense. The verb should be in the past participle form. The correct form is <span class='font-bold'>decided</span>.</p>"
                ],
                [
                    "sentence" => 2,
                    "content" => "<p>After <span class='hint'>finishing</span> his breakfast, Tom sits down to read the newspaper. As he flips through the pages, he realizes that he <span class='hint'>forgot</span> to buy milk. Quickly, he grabs his keys and <span class='hint answer'>head</span> out to the store.</p>",
                    "mistake" => "head",
                    "correction" => "heads",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The subject of the sentence is <span class='font-bold'>he</span>, which is singular. The verb should be in the third person singular form. The correct form is <span class='font-bold'>heads</span>.</p>"
                ],
                [
                    "sentence" => 3,
                    "content" => "<p>The teacher <span class='hint'>gave</span> the students <span class='hint answer'>book</span> to read over the summer.</p>",
                    "mistake" => "book",
                    "correction" => "a book",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The noun <span class='font-bold'>book</span> is countable. It should be preceded by an article. The correct form is <span class='font-bold'>a book</span>.</p>"
                ]
            ]
        ],
        [
            "round" => 2,
            "author" => "Author Name",
            "sentences" => [
                [
                    "sentence" => 1,
                    "content" => "<p>She regretted not <span class='hint answer'>to have</span> <span class='hint'>accepted</span> the job offer from the company that <span class='hint'>aligned</span> more with her values.</p>",
                    "mistake" => "to have",
                    "correction" => "having",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The verb <span class='font-bold'>regret</span> is followed by the gerund form of the verb. The correct form is <span class='font-bold'>having</span>.</p>"
                ],
                [
                    "sentence" => 2,
                    "content" => "<p>Yesterday I <span class='hint'>saw</span> a boy <span class='hint'>and</span> his dog <span class='hint answer'>which</span> were running <span class='hint'>in the yard</span>.</p>",
                    "mistake" => "which",
                    "correction" => "that",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The relative pronoun <span class='font-bold'>which</span> is used to refer to things. The correct form is <span class='font-bold'>that</span>.</p>"
                ],
                [
                    "sentence" => 3,
                    "content" => "<p>The teacher <span class='hint'>said</span> that <span class='hint'>the earth</span> <span class='hint'>moved</span> around <span class='hint'>the sun</span>.</p>",
                    "mistake" => "moved",
                    "correction" => "moves",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The verb <span class='font-bold'>said</span> is in the past tense. The verb <span class='font-bold'>move</span> should be in the present tense. The correct form is <span class='font-bold'>moves</span>.</p>"
                ]
            ]
        ]
    ];
    public function endSentence()
    {
        $this->endSencene = true;
        $this->dispatch("endSentence");
    }
    public function setData()
    {
        $currentRoundData = array_filter($this->data, function ($item) {
            return $item['round'] == $this->currentRound;
        });
        $currentSentenceData = array_filter($currentRoundData[$this->currentRound-1]['sentences'], function ($item) {
            return $item['sentence'] == $this->currentSentence;
        });
        
        $this->currentData = [
            'round' => $currentRoundData[$this->currentRound-1]['round'],
            'author' => $currentRoundData[$this->currentRound-1]['author'],
            'sentence' => $currentSentenceData[$this->currentSentence-1]['sentence'],
            'content' => $currentSentenceData[$this->currentSentence-1]['content'],
            'mistake' => $currentSentenceData[$this->currentSentence-1]['mistake'],
            'correction' => $currentSentenceData[$this->currentSentence-1]['correction'],
            'level' => $currentSentenceData[$this->currentSentence-1]['level'],
            'point' => $currentSentenceData[$this->currentSentence-1]['point'],
            'explanation' => $currentSentenceData[$this->currentSentence-1]['explanation']
        ];
    }
    public function startGame()
    {
        $this->isStarted = true;
        $this->pageLoad = "ready";
        $this->dispatch('startGame');
    }
    public function endGame()
    {
        $this->reStartGame();
    }
    public function reStartGame()
    {
        $this->isStarted = false;
        $this->pageLoad = "waitstart";
        $this->currentRound = 1;
        $this->currentSentence = 0;
        $this->currentData = [];
        $this->state = "old";
        $this->isLastOne = false;
        $this->endSencene = false;
    }
    public function nextSentence()
    {
        $this->endSencene = false;
        if ($this->currentSentence == count($this->data[0]['sentences'])) {
            $this->currentRound++;
            $this->currentSentence = 1;
        } else {
            $this->currentSentence++;
        }
        if($this->currentRound == count($this->data) && $this->currentSentence == count($this->data[0]['sentences'])){
            $this->isLastOne = true;
        }
        $this->pageLoad = "sentence".$this->currentSentence;
        $this->setData();
        $this->dispatch("nextSentence");
    }
    public function render()
    {
        return view('livewire.find-mistake');
    }
}
