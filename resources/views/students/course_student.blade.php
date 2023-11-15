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
            {{ __('NOTES DE '.$course->name) }}
        </h2>
    </x-slot>
    
<div class="overflow-x-auto shadow-md p-10 border-slate-900 sm:rounded-lg flex justify-between">
   <table class="border shadow-md w-96 bg-white ">
        <thead>
            <tr>
                <th class="border text-lg" >Controle continu</th>
                <th class="border text-lg">Session Normale</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @php
                    $ccNote = null;
                    $snNote = null;
        
                    foreach($course_student->note as $note) {
                        
                        if($note->type == 'CC' && $note->status==1) {
                            $ccNote = $note->note;
                        }
        
                        if($note->type == 'SN' && $note->status==1) {
                            $snNote = $note->note;
                        }
                    }
                @endphp
        
                <th scope="row"  class="border p-3">{{ $ccNote ?? 'indisponible' }} </td>
                <th scope="row" class="border p-3">{{ $snNote ?? 'indisponible' }} </td>
            </tr>
        </tbody>
   </table>
    <div>
        <span class="font-bold">
            CODE DU COURS:
        </span>
        <span class="font-bold text-orange-500">
            {{$course->code}}
        </span>
    </div>
   
</div>

</x-app-layout>
