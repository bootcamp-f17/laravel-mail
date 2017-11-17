@extends('layouts.app-panel')

@section('title')

  <a href="{{ URL::previous() }}" class="btn btn-xs btn-default">Back</a>

  <div class="pull-right">

    <form class="button-form" method="post" action="/messages/{{ $message->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button class="btn btn-xs btn-default">
        @if ($authorizedMessage->pivot->deleted_at != null)
          <i class="fa fa-undo" aria-hidden="true"></i>
        @elseif($message->is_deleted == true)
          <i class="fa fa-undo" aria-hidden="true"></i>
        @else
          <i class="fa fa-trash" aria-hidden="true"></i>
        @endif
      </button>
    </form>

@if ($show_star)
    <form class="button-form" method="post" action="/messages/{{ $message->id }}/star">
      {{ csrf_field() }}
      <button class="btn btn-xs btn-default {{ $star_class }}"><strong>&#9734;</strong></button>
    </form>
@endif

  </div>


@endsection

@section('content')

  <form class="form-horizontal">
  <div class="form-group">
    <label class="col-sm-2 control-label">From</label>
    <div class="col-sm-10">
      <p class="form-control-static">{{ $message->sender()->first()->name }}</p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">To</label>
    <div class="col-sm-10">
      <p class="form-control-static">
        
@foreach ($message->recipients()->get() as $recipient)

          {{ $recipient->name }}

@endforeach

      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Subject</label>
    <div class="col-sm-10">
      <p class="form-control-static">{{ $message->subject }}</p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Date</label>
    <div class="col-sm-10">
      <p class="form-control-static">{{ $message->prettySent() }}</p>
    </div>
  </div>
  <hr />
  <div class="form-group">
    <div class="col-sm-12">
      {{ $message->body }}
    </div>
  </div>
</form>

<hr>
<form method="POST" action="/messages">
                        {{ csrf_field() }}
    
@foreach($message->recipients()->get() as $recipient)
  @if ($recipient->id !== \Auth::user()->id ) 


  <input name="recipients[]" type="hidden" value="{{ $recipient->id }}">

  @endif
@endforeach

    <input name="recipients[]" type="hidden" value="{{ $message->sender_id }}">
    
    <input name="sender" type="hidden" value="{{ $message->sender_id }}">


  <input name="subject" type="hidden" value="{{ $message->subject }}">
      <div class="form-group">
          <label for="messageContent"></label>
          <div contenteditable="true" class="form-control editable" id="body" name="body" placeholder="Reply here" required>
          <br><br><hr>

            <p>On {{ $message->prettySent() }}, {{ $message->sender()->first()->name }} wrote:</p>
            <p style="margin-left: 20px;">{{ $message->body }} </p>


          </div>
      </div>
      <div class="form-group">
          <button type="submit" name="button" value="replyOne" class="btn btn-primary">Reply</button>
          <button type="submit" name="button" value="replyAll" class="btn btn-primary">Reply All</button>
      </div>
</form>



@endsection