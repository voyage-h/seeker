<div class="card" id="answers">
  <div class="card-header">动态</div>
  <div class="card-body">
                <ul class="list-group list-group-flush">

                    @foreach(App\Notification::where('data->user->id',$user->id)->get() as $note)
                    @php $data = $note->data; @endphp
                    @switch($note->type)

                    {{-- 关注 --}}
                    @case('App\Notifications\FollowNotification')
                    <li class="list-group-item">
                    关注了
                    <a href="{{ route('user.show',[$note->notifiable_id]) }}"> {{ App\User::find($note->notifiable_id)->name }} </a>
                    </li>
                    @break

                    {{-- 评论问题 --}}
                    @case('App\Notifications\CommentQuestionNotification')
                    <li class="list-group-item">
                    评论了问题
                    <a href="{{ route('question.show',[$data->question->id]) }}"> {{ $data->question->title }}</a>
                    </li>
                    @break

                    {{-- 评论回答 --}}
                    @case('App\Notifications\CommentAnswerNotification')
                    <li class="list-group-item">
                    评论了回答
                    <a href="{{ route('question.show',[$data->question->id]) }}#answer{{ $data->answer }}"> {{ $data->question->title }}</a>
                    </li>
                    @break

                    {{-- 回答问题 --}}
                    @case('App\Notifications\AnswerQuestionNotification')
                    <li class="list-group-item">
                    回答了问题
                    <a href="{{ route('question.show',[$data->question->id]) }}#answer{{ $data->answer }}"> {{ $data->question->title }}</a>
                    </li>
                    @break

                    {{-- 点赞 --}}
                    @case('App\Notifications\LikeNotification')
                    <li class="list-group-item">
                    赞了回答
                    <a href="{{ route('question.show',[$data->question->id]) }}#answer{{ $data->answer }}"> {{ $data->question->title }}</a>
                    </li>
                    @break

                    @endswitch
                    @endforeach
                </ul>
  </div>
</div>
