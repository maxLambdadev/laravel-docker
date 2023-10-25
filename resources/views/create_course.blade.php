<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="border-b p-6 text-gray-900">
                    {{ __('Add New Course') }}
                </div>
                <div class="p-12 text-gray-900">
                    <form method="POST" action="{{ route('createstore') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div x-data="{ selectedOption: '' }">
                            <x-input-label for="select_course" :value="__('Which course do you offer')" />
                            <select id="select_course" class="block w-3/5 mt-1 rounded-md border-gray-300 " name="select_course" x-model="selectedOption" autofocus>
                                <option value="">Other please specify</option>
                                @foreach ($courses as $course)
                                <option value="{{$course}}">{{$course}}</option>
                                @endforeach
                                
                            </select>
                           
                            <x-input-label for="name" :value="__('Course Name')" x-show="selectedOption === ''" class="mt-4"/>
                            <x-text-input id="name" class="block mt-1 w-3/5 mr-1" x-show="selectedOption === ''" type="text" name="name" x-bind:value="selectedOption" required autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-4 flex flex-row">
                            <div class="w-full mr-3">
                                <x-input-label for="duration" :value="__('Duration')" />
                                <div class="flex flex-row">
                                    <x-text-input id="duration" class="block mt-1 w-full " type="number" name="duration" :value="old('duration')" required  autocomplete="duration" /> 
                                    <span class="flex items-center ml-2">Hours</span>
                                </div>
                                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                            </div>    
                            
                            <div class="w-full ml-3">
                                <x-input-label for="price" :value="__('Price')" />
                                <div class="flex flex-row">
                                    <span class="flex items-center bg-gray-300 rounded rounded-r-none px-4 mt-1">£</span>
                                    <x-text-input type="number" id="price" name="price" class="block mt-1 w-full rounded-l-none" :value="old('price')" required autocomplete="price"/>
                                </div>
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            
                                
                        </div>
                        <div class="mt-4 flex flex-row">
                            <div class="w-full mr-3">
                                <x-input-label for="min_parts" :value="__('Min Participants')" />
                                <x-text-input id="min_parts" class="block mt-1 w-full " type="number" name="min_parts" :value="old('min_parts')" required  autocomplete="min_parts" /> 
                                <x-input-error :messages="$errors->get('min_parts')" class="mt-2" />
                            </div>    
                            
                            <div class="w-full ml-3">
                                <x-input-label for="max_parts" :value="__('Max Participants')" />
                                <x-text-input id="max_parts" class="block mt-1 w-full " type="number" name="max_parts" :value="old('max_parts')" required  autocomplete="max_parts" /> 
                                <x-input-error :messages="$errors->get('max_parts')" class="mt-2" />
                            </div> 
                        </div>
                        <div class="mt-4 flex flex-row">
                            <div class="w-full mr-3">
                                <x-input-label for="level" :value="__('Level')" />
                                <x-text-input id="level" class="block mt-1 w-3/5 mr-1" type="text" name="level" :value="old('level')" required autocomplete="level" />
                                <x-input-error :messages="$errors->get('level')" class="mt-2" />
                            </div>    
                            
                             
                        </div>
                        <div class="mt-4 flex flex-col">
                            <x-input-label for="Region" :value="__('What regions do you offer')" class="mb-3"/>
                            <div class="border rounded-md border-gray-300 flex flex-col p-6">
                                <label class="mt-2">
                                    <span class="mr-7">{{__('London - England')}}</span> <input type="checkbox" name="region[]" value="London - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('East Midlands - England')}}</span> <input type="checkbox" name="region[]" value="East Midlands - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('West Midlands - England')}}</span> <input type="checkbox" name="region[]" value="West Midlands - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('North East - England')}}</span> <input type="checkbox" name="region[]" value="North East - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('North West - England')}}</span> <input type="checkbox" name="region[]" value="North West - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('South West - England')}}</span> <input type="checkbox" name="region[]" value="South West - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('South East - England')}}</span> <input type="checkbox" name="region[]" value="South East - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('Yorkshire & The Humber - England')}}</span> <input type="checkbox" name="region[]" value="Yorkshire & The Humber - England"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('Scotland')}}</span> <input type="checkbox" name="region[]" value="Scotland"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('Wales')}}</span> <input type="checkbox" name="region[]" value="Wales"> 
                                </label>
                                <label class="mt-2">
                                    <span class="mr-7">{{__('Northern Ireland')}}</span> <input type="checkbox" name="region[]" value="Northern Ireland"> 
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('region')" class="mt-2" />
                        </div>
                        <div class="mt-4 flex flex-row">
                            <div class="w-full mr-3">
                                <x-input-label for="format" :value="__('What trainig format do you offer')" />
                                <select name="format" id="format" class="block w-full mt-1 rounded-md border-gray-300" required autocomplete="format">
                                    <option value="">Select format</option>
                                    <option value="osy">On Site (your premises)</option>
                                    <option value="oso">On Site (our premises)</option>
                                    <option value="vff">Virtual Face to Face</option>
                                </select> 
                                <x-input-error :messages="$errors->get('format')" class="mt-2" />
                            </div>    
                            
                            <div class="w-full ml-3">
                                <x-input-label for="certificate" :value="__('Certificate')" />
                                <select name="certificate" id="certificate" class="block w-full mt-1 rounded-md border-gray-300" required autocomplete="certificate">
                                    <option value="">Select certificate</option>
                                    <option value="cert_tra">Certificate of Achievement (assessed by trainer)</option>
                                    <option value="cert_ext">Certificate of Achievement (assessed externally)</option>
                                    <option value="other">Other</option>
                                </select>  
                                <x-input-error :messages="$errors->get('certificate')" class="mt-2" />
                            </div> 
                        </div>
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full rounded-md resize-y border-gray-300 focus:border-blue-500" name="description" :value="old('description')" autocomplete="description" ></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Add') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
</x-app-layout>