<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SiteSetting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6">
                    <h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200 py-4 block sm:inline-block flex">{{ __('Game Setting') }}</h1>
                    @if ($errors->any())
                        <ul class="mt-3 list-none list-inside text-sm text-red-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if(session()->has('message'))
                        <div class="mb-8 text-green-400 font-bold">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
                <div class="w-full px-6 py-4 bg-white overflow-hidden">

                    <form method="POST" action="{{ route('siteSetting.update', $siteSetting->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="py-2">
                            <table style="width: 100%">
                                <tr>
                                    <td>
                                        <label for="text_title" class="block font-medium text-sm text-gray-700{{$errors->has('text_title') ? ' text-red-400' : ''}}">{{ __('Title') }}</label>

                                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1
                                                    w-full{{$errors->has('text_title') ? ' border-red-400' : ''}}"
                                               type="text" name="text_title"
                                               value="{{ old('text_title', $siteSetting->text_title) }}"/>
                                    </td>
                                    <td>
                                        <label for="text_play" class="block font-medium text-sm text-gray-700{{$errors->has('text_play') ? ' text-red-400' : ''}}">{{ __('Text (play)') }}</label>

                                        <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1
                                                    w-full{{$errors->has('text_play') ? ' border-red-400' : ''}}"
                                                type="text"
                                                name="text_play"
                                                value="{{ old('text_play', $siteSetting->text_play) }}"
                                        />
                                    </td>
                                    <td>
                                        <label for="text_replay" class="block font-medium text-sm text-gray-700{{$errors->has('text_replay') ? ' text-red-400' : ''}}">{{ __('Text (replay)') }}</label>

                                        <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1
                                                    w-full{{$errors->has('text_replay') ? ' border-red-400' : ''}}"
                                                type="text"
                                                name="text_replay"
                                                value="{{ old('text_replay', $siteSetting->text_replay) }}"
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="text_higher" class="block font-medium text-sm text-gray-700{{$errors->has('text_higher') ? ' text-red-400' : ''}}">{{ __('Text (higher)') }}</label>

                                        <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1
                                                    w-full{{$errors->has('text_higher') ? ' border-red-400' : ''}}"
                                                type="text"
                                                name="text_higher"
                                                value="{{ old('text_higher', $siteSetting->text_higher) }}"
                                        />
                                    </td>
                                    <td>
                                        <label for="text_lower" class="block font-medium text-sm text-gray-700{{$errors->has('text_lower') ? ' text-red-400' : ''}}">{{ __('Text (lower)') }}</label>

                                        <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1
                                                    w-full{{$errors->has('text_lower') ? ' border-red-400' : ''}}"
                                                type="text"
                                                name="text_lower"
                                                value="{{ old('text_lower', $siteSetting->text_lower) }}"
                                        />
                                    </td>
                                    <td>
                                        <label for="text_title" class="block font-medium text-sm text-gray-700{{$errors->has('live') ? ' text-red-400' : ''}}">{{ __('live') }}</label>

                                        <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1
                                                    w-full{{$errors->has('live') ? ' border-red-400' : ''}}"
                                                type="text"
                                                name="live"
                                                value="{{ old('live', $siteSetting->live) }}"
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label for="background_color" class="block font-medium text-sm text-gray-700{{$errors->has('background_color') ? ' text-red-400' : ''}}">{{ __('Background Volor') }}</label>

                                        <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1
                                                    w-full{{$errors->has('background_color') ? ' border-red-400' : ''}}"
                                                type="text"
                                                name="background_color"
                                                value="{{ old('background_color', $siteSetting->background_color) }}"
                                        />
                                    </td>
                                    <td>
                                        <label for="btn_color" class="block font-medium text-sm text-gray-700{{$errors->has('btn_color') ? ' text-red-400' : ''}}">{{ __('Btn Color') }}</label>

                                        <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1
                                                    w-full{{$errors->has('btn_color') ? ' border-red-400' : ''}}"
                                                type="text"
                                                name="btn_color"
                                                value="{{ old('btn_color', $siteSetting->btn_color) }}"
                                        />
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type='submit' class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
