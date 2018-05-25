@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          
             <div class="avatar-normal">
             <a data-toggle="modal" data-target="#upload"><img class="card-img-top" src="{{ asset("images/avatar/$user->avatar") }}" alt="Card image cap"></a>
             </div>
             <div class="card" style="position: relative;">
              <div class="card-header">
              <h5>{{ $user->name }}</h5>
              @if($user->id != Auth::id())
              <a href="{{ route('message.read',[$user->id]) }}" class="btn-card-header">私信</a>
              <a class="btn-card-header" href="{{ route('user.follow',[$user->id]) }}">
              @if(Auth::user()->followed($user->id))
              {{ $user->followed(Auth::id()) ? '互相关注' : '取消关注' }}
              @else
              关注
              @endif
              </a>
              @endif
              </div>
              <div class="card-body">
              <a href="{{ route('user.show',[$user->id]) }}" class="btn btn-link {{Route::currentRouteName()=='user.show' ? 'btn-link-active':''}}">动态</a>
              <a href="{{ route('user.answers',[$user->id]) }}" class="btn btn-link {{Route::currentRouteName()=='user.answers' ? 'btn-link-active':''}}">回答 {{ $user->answers->count() }}</a>
              <a href="{{ route('user.questions',[$user->id]) }}" class="btn btn-link {{Route::currentRouteName()=='user.questions' ? 'btn-link-active':''}}">提问  {{ $user->questions->count() }}</a>
              <a href="{{ route('user.follows',[$user->id]) }}" class="btn btn-link {{Route::currentRouteName()=='user.follows' ? 'btn-link-active':''}}">{{ Auth::id()==$user->id ? '我':'TA' }}的关注 {{ $user->follows()->count() }}</a>
              <a href="{{ route('user.followers',[$user->id]) }}" class="btn btn-link {{Route::currentRouteName()=='user.followers' ? 'btn-link-active':''}}">{{ Auth::id()==$user->id ? '我':'TA' }}的粉丝 {{ $user->followers()->count() }}</a>
              </div>
             </div>

             @if(Route::currentRouteName() == 'user.show') 
             @include('user.profile',['user'=>$user])
             @else
             @include(Route::currentRouteName(),['user'=>$user])
             @endif

        </div>
    </div>
</div>
@if($user->id == Auth::id())
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form id="upload-form" target="upload-iframe" method="post" action="{{ route('user.avatar') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">上传头像</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body center">
      <img id="upload-img" src="{{ asset("images/avatar/$user->avatar") }}" style="max-width:300px">
      <input type="file" name="avatar" class="hide" id="upload-input">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">保存</button>
      </div>
      </form>
       <iframe id="upload-iframe" name="upload-iframe" style="display: none;"></iframe>
    </div>
  </div>
</div>
@endif
@endsection
