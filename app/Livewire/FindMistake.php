<?php

namespace App\Livewire;

use Livewire\Component;


class FindMistake extends Component
{
    public $timer = 60;
    public $timerReady = 1;
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
            "sentences" => [[
                "sentence" => 1,
                "content" => "<p>She had been <span class='hint'>going</span> to that gym for over a year before she <span class='hint answer'>decides</span> to try a different one.</p>",
                "mistake" => "decides",
                "correction" => "decided",
                "level" => "easy",
                "point" => 2,
                "explanation" => "The sentence is in the past perfect tense. The verb should be in the past participle form. The correct form is decided."
            ],
            [
                "sentence" => 2,
                "content" => "<p>She had been <span class='hint'>going</span> to that gym for over a year before she <span class='hint answer'>decides</span> to try a different one.</p>",
                "mistake" => "decides",
                "correction" => "decided",
                "level" => "easy",
                "point" => 2,
                "explanation" => "The sentence is in the past perfect tense. The verb should be in the past participle form. The correct form is decided."
            ],
            [
                "sentence" => 3,
                "content" => "<p>She had been <span class='hint'>going</span> to that gym for over a year before she <span class='hint answer'>decides</span> to try a different one.</p>",
                "mistake" => "decides",
                "correction" => "decided",
                "level" => "easy",
                "point" => 2,
                "explanation" => "The sentence is in the past perfect tense. The verb should be in the past participle form. The correct form is decided."
            ]]
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
        $currentSentenceData = array_filter($currentRoundData[0]['sentences'], function ($item) {
            return $item['sentence'] == $this->currentSentence;
        });
        
        $this->currentData = [
            'round' => $currentRoundData[0]['round'],
            'author' => $currentRoundData[0]['author'],
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
