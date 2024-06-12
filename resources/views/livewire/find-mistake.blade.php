<div>
    <header class="flex items-center justify-between">
        <div class="flex items-center justify-center">
            <img src="{{asset('libs/images/globe3.png')}}" alt="Logo" class="h-24">
            <div class="animate-jump animate-infinite animate-duration-[2000ms] animate-ease-linear">
                <span class="font-['Anton'] text-4xl tracking-widest font-bold">TEAM A</span>
            </div>
        </div>
        <div>
            @if($isStarted == true)
                <button wire:click="reStartGame" class="text-blue-950 font-['Poppins'] font-bold text-lg mr-10">Restart</button>
            @endif
            <button onclick="showRules()" class="text-blue-950 font-['Poppins'] font-bold text-lg animate-wiggle-more animate-infinite animate-duration-[2000ms] animate-delay-1000 animate-ease-linear">How to play !</button>

            <div id="rulesModal" class="fixed inset-0 flex z-10 items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white rounded-lg max-w-3xl">
                    <button onclick="hideRules()" class="text-blue-950 font-['Poppins'] font-bold text-lg p-2 float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="p-6 mt-6">
                        <h2 class="font-['Anton'] text-4xl font-bold mb-4 text-center">How to Play ?</h2>
                        <div class="flex justify-between">
                            <div class="w-1/5 content-center relative">
                                <img src="{{asset('libs/images/Picture8.png')}}" alt="Logo" class="absolute top-2 h-36">
                                <img src="{{asset('libs/images/Picture9.png')}}" alt="Logo" class="absolute top-10 left-8 h-16">
                                <img src="{{asset('libs/images/Picture10.png')}}" alt="Logo" class="absolute top-[-35px] h-8">
                                <img src="{{asset('libs/images/Picture11.png')}}" alt="Logo" class="absolute top-[-45px] right-0 h-8">
                                <img src="{{asset('libs/images/Picture12.png')}}" alt="Logo" class="absolute top-[-70px] right-10 h-10">
                            </div>
                            <div class="w-4/5 content-center">
                                <ul class="list-disc pl-6 leading-6 text-">
                                    <li>The game will have <b>5 rounds</b>, each round will have <b>3 questions</b> and each team will have 1 member to participate.</li>
                                    <li class="mt-5">The rule of the game is that each sentence will have at <b>least one mistake</b>. Whoever finds the mistakes and fixes it fastest will win <b>(Before 30 seconds you will get 2 points, after 30 seconds you will have a hint, you will get 1 point)</b>.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showRules() {
                    document.getElementById('rulesModal').classList.remove('hidden');
                }

                function hideRules() {
                    document.getElementById('rulesModal').classList.add('hidden');
                }
            </script>
        </div>
    </header>
    <div class="flex justify-between h-[450px]">
        @if($isStarted == false)
            <div class="w-1/2 content-center">
                <div class="flex-row items-center justify-center text-center">
                    <div class="animate-shake animate-infinite animate-duration-[2000ms] animate-ease-linear">
                        <button wire:click="startGame" class="font-['Poppins'] text-xl tracking-widest bg-sky-300 rounded-2xl px-6 py-1.5 font-bold text-blue-950">Let's Play !</button>
                    </div>
                    <div class="m-auto mt-5">
                        <h1 class="font-['Anton'] text-7xl tracking-widest font-bold text-blue-950">Find <br> the <br> mistakes</h1>
                    </div>
                </div>
            </div>
            <div class="w-1/2 relative">
                <img src="{{asset('libs/images/Picture1.png')}}" alt="Image" class="absolute top-28 left-24 w-[260px]">
                <img src="{{asset('libs/images/Picture2.png')}}" alt="Image" class="absolute top-48 left-40 w-[120px]">
                <img src="{{asset('libs/images/Picture3.png')}}" alt="Image" class="absolute top-16 left-16 w-[80px]">
                <img src="{{asset('libs/images/Picture4.png')}}" alt="Image" class="absolute bottom-16 left-16 w-[80px]">
                <img src="{{asset('libs/images/Picture5.png')}}" alt="Image" class="absolute top-16 right-40 w-[80px]">
                <img src="{{asset('libs/images/Picture6.png')}}" alt="Image" class="absolute bottom-16 right-40 w-[90px]">
            </div>
        @else
            @if($pageLoad == "ready")
                <div class="w-full content-center">
                    <div class="flex items-center justify-center">
                        <h1 class="font-['Anton'] text-7xl tracking-widest font-bold text-blue-950">Get Ready!</h1>
                    </div>
                    <div class="flex items-center justify-center mt-5">
                        <h2 id="countdown" class="font-['Anton'] text-9xl tracking-widest font-bold text-blue-950">{{$timerReady}}</h2>
                    </div>
                </div>

                @script
                    <script>
                        window.addEventListener('startGame', event => {
                            let countdown = {{$timerReady}};
                            setTimeout(() => {
                                const countdownElement = document.getElementById('countdown');
                                const interval = setInterval(() => {
                                    countdown--;
                                    countdownElement.innerText = countdown;
                                    if (countdown === 0) {
                                        clearInterval(interval);
                                        @this.call('nextSentence');
                                    }
                                }, 1000);
                            }, 500);
                        });
                    </script>
                @endscript
            @else
                <div class="w-full">
                    <div class="flex items-center justify-center">
                        <h1 class="font-['Anton'] text-5xl tracking-widest font-bold text-blue-950">Round {{$currentData['round']}} | <span class="text-sky-500">Sentence {{$currentData['sentence']}}</span></h1>
                    </div>
                    <div class="flex items-center justify-center mt-5">
                        <h2 id="countdown" class="font-['Anton'] text-6xl tracking-widest font-bold text-sky-500">{{$timer}}</h2>
                    </div>
                    <div class="flex items-center justify-center p-6 bg-gray-50 rounded-2xl mt-5">
                        <h3 class="font-['Poppins'] text-2xl font-bold text-blue-950 leading-8">{!!$currentData['content']!!}</h3>
                    </div>
                    <div id="result" class="flex items-center justify-center content-center hidden">
                        <h3 class="font-['Anton'] text-2xl font-bold text-blue-950">Answer :</h3>
                        <div class="flex items-center justify-center content-center">
                            <span class="m-5 font-['Poppins'] text-lg text-blue-950 p-2 rounded-md bg-white font-bold text-red-700">{{$currentData['mistake']}}</span>
                            <span>=></span>
                            <span class="m-5 font-['Poppins'] text-lg text-blue-950 p-2 rounded-md bg-white font-bold text-green-400">{{$currentData['correction']}}</span>
                        </div>
                    </div>
                    <div id="explaination" class="flex p-6 bg-green-200 content-center rounded-2xl mt-5 hidden">
                        {!!$currentData['explanation']!!}
                    </div>

                    <div class="flex items-center justify-center mt-5">
                        @if($isLastOne)
                            <button wire:click="endGame" class="font-['Poppins'] text-xl tracking-widest bg-sky-300 rounded-2xl px-6 py-1.5 font-bold text-blue-950">Finish</button>
                        @else
                            @if($endSencene == false)
                                <button wire:click="endSentence" class="font-['Poppins'] text-xl tracking-widest bg-red-600 rounded-2xl px-6 py-1.5 font-bold text-blue-950 mr-5">Stop</button>
                            @endif
                            <button wire:click="nextSentence" class="font-['Poppins'] text-xl tracking-widest bg-sky-300 rounded-2xl px-6 py-1.5 font-bold text-blue-950">Next Sentence</button>
                        @endif
                    </div>
                </div>
                @script
                    <script>
                        let intervalID;
                        function showHint() {
                                const allHints = document.getElementsByClassName('hint');
                                Array.from(allHints).forEach(hint => {
                                    hint.classList.add('bg-sky-300', 'p-2', 'rounded-lg');
                                });
                            }

                        function showResult() {
                            const allHints = document.getElementsByClassName('hint');
                            Array.from(allHints).forEach(hint => {
                                hint.classList.remove('bg-sky-300', 'p-2', 'rounded-lg');
                            });
                            const answer = document.getElementsByClassName('answer');
                            answer[0].classList.add('bg-red-600', 'p-2', 'rounded-lg');
                            const countdownElement = document.getElementById('countdown');
                            document.getElementById('result').classList.remove('hidden');
                            document.getElementById('explaination').classList.remove('hidden');
                            countdownElement.classList.add('hidden');
                            document.getElementById('result').classList.add('animate-jump-in', 'animate-duration-[2000ms]', 'animate-delay-1000', 'animate-ease-linear');
                            document.getElementById('explaination').classList.add('animate-jump-in', 'animate-duration-[2000ms]', 'animate-delay-1000', 'animate-ease-linear');
                        }
                        window.addEventListener('nextSentence', event => {
                            let countdown = {{$timer}};
                            if (intervalID) {
                                clearInterval(intervalID);
                            }
                            setTimeout(() => {
                                const countdownElement = document.getElementById('countdown');
                                intervalID = setInterval(() => {
                                    countdown--;
                                    countdownElement.innerText = countdown;
                                    if (countdown === 30) {
                                        countdownElement.classList.add('text-orange-500');
                                        showHint();
                                    }
                                    if (countdown === 20) {
                                        countdownElement.classList.add('text-red-400');
                                    }
                                    if (countdown <= 10) {
                                        countdownElement.classList.remove('animate-jump');
                                        void countdownElement.offsetWidth;
                                        countdownElement.classList.add('text-red-600', 'animate-jump');
                                    }
                                    if (countdown === 0) {
                                        countdownElement.classList.add('text-red-900');
                                        clearInterval(intervalID);
                                        setTimeout(() => {
                                            showResult();
                                        }, 1000);
                                    }
                                }, 1000);
                            }, 500);
                        });
                        window.addEventListener('endSentence', event => {
                            if (intervalID) {
                                clearInterval(intervalID);
                                setTimeout(() => {
                                    showHint();
                                    showResult();
                                }, 1000);
                            }
                        }); 
                    </script>
                @endscript
            @endif
        @endif
    </div>
<div>