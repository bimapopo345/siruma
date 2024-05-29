@foreach($userporfil as $usp)
@if($usp->foto_profil == NULL)
<img src="{{asset('template_new/assets/img/avatars/1.png')}}" alt class="w-px-40 h-40 rounded-circle" />
@else
<img src="{{asset('profil')}}/{{$usp->foto_profil}}" alt class="w-px-40 h-40 rounded-circle" />
@endif
@endforeach
