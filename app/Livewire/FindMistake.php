<?php

namespace App\Livewire;

use Livewire\Component;


class FindMistake extends Component
{
    public $timer = 60;
    public $timerReady = 5;
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
            "sentences" => [
                [
                    "sentence" => 1,
                    "content" => "<p>I <span class='hint'>really</span> <span class='hint'>appreciate</span> the <span class='hint answer'>advices</span> the mentor <span class='hint'>gave</span> me.",
                    "mistake" => "advices",
                    "correction" => "advice",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p><span class='font-bold'>Advice</span> is an uncountable noun. It does not have a plural form. The correct form is <span class='font-bold'>advice</span>.</p>",
                    "author" => "Phuc",
                ],
                [
                    "sentence" => 2,
                    "content" => "<p>After <span class='hint'>finishing</span> his breakfast, Tom sits down to read the newspaper. As he flips through the pages, he realizes that he <span class='hint'>forgot</span> to buy milk. Quickly, he grabs his keys and <span class='hint answer'>head</span> out to the store.</p>",
                    "mistake" => "head",
                    "correction" => "heads",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The subject of the sentence is <span class='font-bold'>he</span>, which is singular. The verb should be in the third person singular form. The correct form is <span class='font-bold'>heads</span>.</p>",
                    "author" => "Huy"
                ],
                [
                    "sentence" => 3,
                    "content" => "<p>The teacher <span class='hint'>gave</span> the students <span class='hint answer'>book</span> to read over <span class='hint'>the summer</span>.</p>",
                    "mistake" => "book",
                    "correction" => "a book",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The noun <span class='font-bold'>book</span> is countable. It should be preceded by an article. The correct form is <span class='font-bold'>a book</span>.</p>",
                    "author" => "Jolie",
                ]
            ]
        ],
        [
            "round" => 2,
            "sentences" => [
                [
                    "sentence" => 1,
                    "content" => "<p>The teacher <span class='hint'>said</span> that <span class='hint'>the earth</span> <span class='hint answer'>moved</span> around <span class='hint'>the sun</span>.",
                    "mistake" => "moved",
                    "correction" => "moves",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>It is an obvious fact that the earth moves around the sun, so the verb in the indirect sentence does not change tense. Therefore, <span class='font-bold'>moved</span> must be changed to <span class='font-bold'>moves</span>.</p>",
                    "author" => "Min",
                ],
                [
                    "sentence" => 2,
                    "content" => "<p>Yesterday I <span class='hint'>saw</span> a boy <span class='hint'>and</span> his dog <span class='hint answer'>which</span> were running <span class='hint'>in the yard</span>.</p>",
                    "mistake" => "which",
                    "correction" => "that",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The relative pronoun <span class='font-bold'>which</span> is used to refer to things. The correct form is <span class='font-bold'>that</span>.</p>",
                    "author" => "Vinh",
                ],
                [
                    "sentence" => 3,
                    "content" => "<p>The <span class='hint'>traffic</span> in the city <span class='hint answer'>are</span> overwhelming <span class='hint'>during</span> peak <span class='hint'>hours</span>.</p>",
                    "mistake" => "are",
                    "correction" => "is",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p><span class='font-bold'>Traffic</span> is an uncountable noun, so <span class='font-bold'>is</span> is correct answers.</p>",
                    "author" => "Phuc",
                ]
            ]
        ],
        [
            "round" => 3,
            "sentences" => [
                [
                    "sentence" => 1,
                    "content" => "<p>She had been <span class='hint'>going</span> to that gym for over a year before she <span class='hint answer'>decides</span> to try a different <span class='hint'>one</span>.</p>",
                    "mistake" => "decides",
                    "correction" => "decided",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The sentence is in the past perfect tense. The verb should be in the past participle form. The correct form is <span class='font-bold'>decided</span>.</p>",
                    "author" => "Huy"
                ],
                [
                    "sentence" => 2,
                    "content" => "<p><span class='hint'>The more tired</span> the students <span class='hint'>were</span>, <span class='hint answer'>the more hard</span> it was to absorb the information <span class='hint'>in the lecture</span>.</p>",
                    "mistake" => "the more hard",
                    "correction" => "the harder",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>Structure: <span class='font-bold'>'The'</span> + compared (increasingly...). With short adjectives, adjective + <span class='font-bold'>'er'</span>. Therefore, <span class='font-bold'>'the more hard'</span> must be changed to <span class='font-bold'>'the harder'</span>.</p>",
                    "author" => "Vinh",
                ],
                [
                    "sentence" => 3,
                    "content" => "<p>The professor <span class='hint'>requested</span> that <span class='hint'>all</span> assignments <span class='hint answer'>are</span> submitted before <span class='hint'>the</span> weekend.</p>",
                    "mistake" => "are",
                    "correction" => "be",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>Structure: <span class='font-bold'>'Request'</span> that <span class='font-bold'>+ S + V (bare infinitive)</span>. Therefore, the verb <span class='font-bold'>'are'</span> must be changed to the infinitive <span class='font-bold'>'be'</span>.</p>",
                    "author" => "Min",
                ]
            ]
        ],
        [
            "round" => 4,
            "sentences" => [
                [
                    "sentence" => 1,
                    "content" => "<p>She <span class='hint'>was</span> <span class='hint'>very</span> <span class='hint'>tired</span> because she <span class='hint answer'>is</span> worked all day.",
                    "mistake" => "is",
                    "correction" => "had",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The sentence is in the past tense. The verb should be in the past simple form. The correct form is <span class='font-bold'>had</span>.</p>",
                    "author" => "Phuc",
                ],
                [
                    "sentence" => 2,
                    "content" => "<p>She <span class='hint'>is</span> the <span class='hint'>nicest</span> woman <span class='hint answer'>whom</span> I have ever known.</p>",
                    "mistake" => "whom",
                    "correction" => "that",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The relative pronoun <span class='font-bold'>whom</span> is used to refer to people. The correct form is <span class='font-bold'>that</span>.</p>",
                    "author" => "Jolie",
                ],
                [
                    "sentence" => 3,
                    "content" => "<p>The role of <span class='hint answer'>film directions</span> extends beyond just <span class='hint'>overseeing</span> the shooting; they are <span class='hint'>instrumental in</span> post-production processes <span class='hint'>as well</span>.</p>",
                    "mistake" => "film directions",
                    "correction" => "film directors",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>Mistakes in word usage. Should have used <span class='font-bold'>directors</span> instead of <span class='font-bold'>directions</span>.</p>",
                    "author" => "Vinh",
                ]
            ]
        ],
        [
            "round" => 5,
            "sentences" => [
                [
                    "sentence" => 1,
                    "content" => "<p>She regretted not <span class='hint answer'>to have</span> <span class='hint'>accepted</span> the job offer from the company that <span class='hint'>aligned</span> more with her values.</p>",
                    "mistake" => "to have",
                    "correction" => "having",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>The verb <span class='font-bold'>regret</span> is followed by the gerund form of the verb. The correct form is <span class='font-bold'>having</span>.</p>",
                    "author" => "Jolie",
                ],
                [
                    "sentence" => 2,
                    "content" => "<p><span class='hint answer'>Despite of</span> his busy schedule, John always <span class='hint'>find</span> time to exercise. He <span class='hint'>believes</span> that maintaining a healthy lifestyle is important for his well-being.</p>",
                    "mistake" => "Despite of",
                    "correction" => "Despite",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>Using <span class='font-bold'>Despite of</span> is incorrect because <span class='font-bold'>despite</span> and <span class='font-bold'>of</span> do not go together in English grammatical structure. In fact, <span class='font-bold'>despite</span> already contains the meaning of <span class='font-bold'>of</span> in English, so there is no need to use <span class='font-bold'>of</span> after <span class='font-bold'>despite</span>.</p>",
                    "author" => "Huy",
                ],
                [
                    "sentence" => 3,
                    "content" => "<p>Anybody <span class='hint answer'>who</span> <span class='hint'>aspires</span> to be a leader must <span class='hint'>first</span> learn <span class='hint'>to</span> be a follower.</p>",
                    "mistake" => "who",
                    "correction" => "that",
                    "level" => "easy",
                    "point" => 2,
                    "explanation" => "<p>A relative pronoun following an indefinite pronoun <span class='font-bold'>anybody</span> must use <span class='font-bold'>that</span>.</p>",
                    "author" => "Min",
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
            'author' => $currentSentenceData[$this->currentSentence-1]['author'],
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
