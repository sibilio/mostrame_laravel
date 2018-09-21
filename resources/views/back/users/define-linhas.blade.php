@if($papelRepository->isMasterOne($registro->papel_id) || $papelRepository->isMaster($registro->papel_id))
   @if($papelRepository->isMasterOne(Auth::user()->papel_id) || $papelRepository->isMaster(Auth::user()->papel_id))
      @include('back.users.tds')
   @endif
@else
   @include('back.users.tds')
@endif
