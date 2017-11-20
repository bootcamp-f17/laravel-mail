@extends('layouts.app-panel')

@section('title')

  <a href="{{ $backURL }}" class="btn btn-xs btn-default">Back</a>



  <div class="pull-right">

    <form class="button-form" method="post" action="/messages/{{ $message->id }}">


      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button class="btn btn-xs btn-default">
        @if ($authorizedMessage->pivot->deleted_at != null && $authorizedMessage->pivot->recipient_id == \Auth::user()->id)
          <i class="fa fa-undo" aria-hidden="true"></i>
        @elseif($message->is_deleted == true &&  $authorizedMessage->pivot->deleted_at != null)
          <i class="fa fa-undo" aria-hidden="true"></i>
        @elseif ($message->is_deleted == true && $message->sender_id == \Auth::user()->id)  
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

    <form class="button-form" method="post" action="/messages/{{ $message->id }}/unread">
            {{ csrf_field() }}
       <button type="submit" name="button" value="unread" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Mark as unread"><i class="fa fa-envelope" aria-hidden="true" ></i></button>
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

          {{ $recipient->name }} <br>

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
      {!! nl2br(e($message->body)) !!}
    </div>
  </div>
</form>

<hr>
<form method="POST" action="/messages">
                        {{ csrf_field() }}
    
@foreach($message->recipients()->get() as $recipient)
   @if ($recipient->id !== \Auth::user()->id ) 


  <input name="recipients[]" type="hidden" value="{{ $recipient->id }}">
  <input name="sender" type="hidden" value="{{ $recipient->id }}">

  @elseif ($message->sender_id !== \Auth::user()->id)

  <input name="recipients[]" type="hidden" value="{{ $recipient->id }}">
  <input name="sender" type="hidden" value="{{ $message->sender_id }}">

  @else
  <input name="sender" type="hidden" value="{{ $message->sender_id }}">
  <input name="recipients[]" type="hidden" value="{{ $message->sender_id}}">

  @endif
@endforeach




  <input name="subject" type="hidden" value="{{ $message->subject }}">
      <div class="form-group">
          <label for="messageContent"></label>
          <textarea contenteditable="true" class="form-control editable" id="body" name="body" placeholder="Reply here" required>




On {{ $message->prettySent() }}, {{ $message->sender()->first()->name }} wrote:

{{ $message->body }}

          </textarea>
      </div>
      <div class="form-group">

        @if (count($message->recipients()->get()) > 1)
          @if ($message->sender_id !== \Auth::user()->id)
             <button type="submit" name="button" value="replyOne" class="btn btn-primary">Reply</button>
          @endif
            <button type="submit" name="button" value="replyAll" class="btn btn-primary">Reply All</button>
        @else
            <button type="submit" name="button" value="replyOne" class="btn btn-primary">Reply</button>
        @endif

      </div>
</form>



@endsection