<?php

namespace App\Livewire;

use Livewire\Component;


class FindMistake extends Component
{
    public $isStarted = false;
    public $pageLoad = "ready";
    public $currentRound = 1;
    public $currentSentence = 1;
    public $currentData = [];
    public $data = [
        [
            "round" => 1,
            "author" => "Author Name",
            "sentences" => [[
                "sentence" => 1,
                "content" => "<p>She had been <span class='hint'>going</span> to that gym for over a year before she <span class='hint'>decides</span> to try a different one.</p>",
                "hint" => ["going", "decides", "year"],
                "mistake" => "decides",
                "correction" => "decided",
                "level" => "easy",
                "point" => 2,
                "explanation" => "The sentence is in the past perfect tense. The verb should be in the past participle form. The correct form is decided."
            ],
            [
                "sentence" => 2,
                "content" => "<p>She had been <span class='hint'>going</span> to that gym for over a year before she <span class='hint'>decides</span> to try a different one.</p>",
                "hint" => ["going", "decides", "year"],
                "mistake" => "decides",
                "correction" => "decided",
                "level" => "easy",
                "point" => 2,
                "explanation" => "The sentence is in the past perfect tense. The verb should be in the past participle form. The correct form is decided."
            ],
            [
                "sentence" => 3,
                "content" => "<p>She had been <span class='hint'>going</span> to that gym for over a year before she <span class='hint'>decides</span> to try a different one.</p>",
                "hint" => ["going", "decides", "year"],
                "mistake" => "decides",
                "correction" => "decided",
                "level" => "easy",
                "point" => 2,
                "explanation" => "The sentence is in the past perfect tense. The verb should be in the past participle form. The correct form is decided."
            ]]
        ]
    ];
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
            'hint' => $currentSentenceData[0]['hint'],
            'sentence' => $currentSentenceData[0]['sentence'],
            'content' => $currentSentenceData[0]['content'],
            'mistake' => $currentSentenceData[0]['mistake'],
            'correction' => $currentSentenceData[0]['correction'],
            'level' => $currentSentenceData[0]['level'],
            'point' => $currentSentenceData[0]['point'],
            'explanation' => $currentSentenceData[0]['explanation']
        ];
    }
    public function startGame()
    {
        $this->isStarted = true;
        $this->dispatch('startGame');
    }
    public function reStartGame()
    {
        $this->isStarted = false;
    }
    public function nextSentence()
    {
        if ($this->currentSentence == count($this->data[$this->currentRound]['sentences'])) {
            $this->currentRound++;
            $this->currentSentence = 1;
        } else {
            $this->currentSentence++;
        }
        $this->setData();
    }

    public function mount(){
        $this->setData();
    }
    public function render()
    {
        return view('livewire.find-mistake');
    }
}
