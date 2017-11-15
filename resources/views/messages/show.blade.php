@extends('layouts.app-panel')

@section('title')

  <a href="{{ URL::previous() }}" class="btn btn-xs btn-default">Back</a>

  <div class="pull-right">

    <form class="button-form" method="post" action="/messages/{{ $message->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button class="btn btn-xs btn-default">
        <i class="fa fa-trash" aria-hidden="true"></i>
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
                  
  <input name="recipients[]" type="hidden" value="{{ $message->sender_id }}">
  <input name="subject" type="hidden" value="{{ $message->subject }}">
      <div class="form-group">
          <label for="messageContent"></label>
          <textarea class="form-control" id="body" name="body" placeholder="Reply here" required></textarea>
      </div>
      <div class="form-group">
          <button type="submit" name="button" value="send" class="btn btn-primary">Send</button>
      </div>
</form>



@endsection