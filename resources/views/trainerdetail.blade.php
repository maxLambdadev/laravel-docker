<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900 ">
                    @if($trainer)
                        @php
                            $regions = "";
                            $regionlist = [];
                            $courses = "";
                            $courselist = [];
                            $formats = "";
                            $formatlist = [];
                            if($trainer[0]['user']['courses'] && count($trainer[0]['user']['courses']) > 0){
                               
                                foreach($trainer[0]['user']['courses'] as $course){
                                    $regs = explode(', ', $course['region']);
                                    if(count($regs) > 0){
                                        foreach($regs as $reg){
                                            if(!in_array($reg, $regionlist, false)){
                                                array_push($regionlist, $reg);
                                            }
                                        }
                                    }
                                    if(!in_array($course['name'], $courselist, false)){
                                        array_push($courselist, $course['name']);
                                    }
                                    if(!in_array($sharedFormat[$course['format']], $formatlist, false)){
                                        array_push($formatlist, $sharedFormat[$course['format']]);
                                    } 
                                }
                            }
                            
                            if (count($regionlist) > 0){ 
                                $regions = implode(", ", $regionlist);
                            }
                            if (count($courselist) > 0){ 
                                $courses = implode(", ", $courselist);
                            }
                            if (count($formatlist) > 0){ 
                                $formats = implode(", ", $formatlist);
                            }
                            
                        @endphp
                         
                    @else
                    @endif
                    <div class="flex justify-center mt-6">
                        <img src="{{ asset('storage/'.$trainer[0]['photo']) }}" alt="" class="w-28 h-28">
                    </div>
                    
                    <div class="flex mt-3">
                        <p class="font-bold mr-2">Provider: </p>
                        <p>{{$trainer[0]['provider']}}</p>
                    </div>
                    <div class="flex mt-3">
                        <p class="font-bold mr-2">Regions Covered: </p>
                        <p>{{$regions}}</p>
                    </div>
                    <div class="flex mt-3">
                        <p class="font-bold mr-2">Courses Offered: </p>
                        <p>{{$courses}}</p>
                    </div>
                    <div class="flex mt-3">
                        <p class="font-bold mr-2">Format: </p>
                        <p>{{$formats}}</p>
                    </div>
                    <div class="flex mt-3">
                        <p class="font-bold mr-2">Bio: </p>
                        <p> {{$trainer[0]['bio']}}</p>
                    </div>
                    
                </div>
                @if (Auth::check())
                    @if(Auth::user()->type)
                    <div class="p-12 pt-4 text-gray-900 ">
                        <form method="POST" action="{{ route('approvetrainer', $trainer[0]['id']) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="mode" value="approve"/> 
                            <div  class="flex flex-row">
                                <p class="font-bold mr-2">Approved: </p>
                                <label class="ml-12">
                                    <input type="radio" name="approved" value="1" {{ $trainer[0]['approved'] ? "checked" : "" }}> Yes
                                </label>

                                <label class="ml-12">
                                    <input type="radio" name="approved" value="0" {{ !$trainer[0]['approved'] ? "checked" : "" }}> No
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('approved')" class="mt-2" />
                            
                            <div class="flex justify-end mt-6">
                                <a class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-500 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-4 " href="{{ route('trainers') }}">
                                    {{ __('Cancel') }}
                                </a>
                                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4 " type="submit">Save</button>
                            </div>
                            
                        </form>
                    </div>
                    @else
                    
                    @endif
                @else
                <div class="p-12 pt-4 text-gray-900 ">
                        <div class="flex">
                            <h3 class="font-bold">Enquire about this course</h3>
                        </div>
                        <form method="POST" action="{{ route('send-enquiry') }}">
                            @csrf
                            <input type="hidden" name="trainer_id" value="{{$trainer[0]['user_id']}}">
                            <input type="hidden" name="provider" value="{{$trainer[0]['provider']}}">
                            <div class="mt-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-2/5" type="text" name="title" :value="old('title')" required placeholder="ex: Mr, Mrs, Ms, Dr" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <!-- Name -->
                            <div class="mt-4">
                                <x-input-label for="name" :value="__('First & Last Name')" />
                                <div class="flex flex-row">
                                    <x-text-input id="firstName" class="block mt-1 w-1/3 mr-1" type="text" name="firstName" :value="old('firstName')" required autocomplete="firstName" placeholder="First Name" />
                                    <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                                
                                    <x-text-input id="lastName" class="block mt-1 w-1/3 ml-1" type="text" name="lastName" :value="old('lastName')" required autocomplete="lastName" placeholder="Last Name"/>
                                    <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="organName" :value="__('Organisation')" />
                                <x-text-input id="organName" class="block mt-1 w-1/2" type="text" name="organName" :value="old('organName')" required autocomplete="organName" placeholder="Organisation"/>
                                <x-input-error :messages="$errors->get('organName')" class="mt-2" />
                            </div>
                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-1/2" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            
                            <div class="mt-4">
                                <x-input-label for="verify_email" :value="__('Verify Email')" />
                                <x-text-input id="verify_email" class="block mt-1 w-1/2" type="email" name="verify_email" required autocomplete="verify_email" placeholder="Verify Email" />
                                <x-input-error :messages="$errors->get('verify_email')" class="mt-2" />
                            </div>
                            
                            <div class="mt-4">
                                <x-input-label for="phone" :value="__('Telephone Number')" />
                                <x-text-input id="phone" class="block mt-1 w-1/2" type="text" name="phone" :value="old('phone')" required autocomplete="phone" placeholder="+44 123 456 7890"/>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="message" :value="__('Message')" />
                                <textarea id="message" class="block mt-1 w-3/5 rounded-md resize-y border-gray-300 focus:border-blue-500" rows="7" name="message" :value="old('message')" required autocomplete="message" ></textarea>
                                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-7 w-3/5">
                                <a class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-500 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-4 " href="{{ route('home') }}">
                                    {{ __('Cancel') }}
                                </a>

                                <x-primary-button class="ml-4">
                                    {{ __('Send Enquiry') }}
                                </x-primary-button>
                            </div>
                        </form>
                        
                    </div>
                @endif

                
            </div>
        </div>

        
    </div>
    
</x-app-layout>
