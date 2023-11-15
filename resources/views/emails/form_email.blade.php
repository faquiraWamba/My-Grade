<x-app-layout>
    @if (session('error'))
    <div id="notification" class="notification notification-error">
        {{ session('error') }}
     </div>
    @endif
    @if (session('success'))
    <div id="notification" class="notification notification-sucess">
        {{ session('success') }}
     </div>
    @endif
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tig">
            {{ __('Message aux parents et aux étudiants') }}
        </h2>
    </x-slot>
    <div class="py-5 ">
        <form action="{{ route('send.message.google',['class_id'=>$class_id,'semester'=>$semester]) }}" method="POST">
            @csrf
            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                    <label for="message"   class="sr-only">Message</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Entrez le mail" required></textarea>
                    {{ $errors->first('message', ":message")}}
                </div>
                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                    <button type="submit" class="inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-orange-500 rounded-lg focus:ring-4 focus:ring-orange-200 dark:focus:ring-blue-900 hover:bg-orange-800">
                        Envoyer
                    </button>
                    <div class="flex pl-0 space-x-1 sm:pl-2">
                        <div class="inline-flex justify-center items-center p-2  text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <p class="ml-auto text-xs text-gray-500 dark:text-gray-400">Notifier les parents et les étudiants que les notes sont disponibles</p>
    </div>

</x-app-layout>