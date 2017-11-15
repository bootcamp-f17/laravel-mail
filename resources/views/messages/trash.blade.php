@extends('layouts.app-panel')

@section('title')

  {{ $title }}

@endsection

@section('content')

  <table class="table">
    <h4>Received Messages</h4>
    <thead>
      <tr>
        <th>From</th>
        <th>Subject</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>

    @foreach ($inboxTrash as $message)
      <tr onclick="document.location='/messages/{{ $message->id }}'">
        <td>{{ $message->sender->name }}</td>
        <td>{{ $message->subject }}</td>
        <td>{{ $message->prettySent() }}</td>
      </tr>
    @endforeach

    </table>

    <br>

    <table class="table">
    <h4>Sent Messages</h4>
    <thead>
      <tr>
        <th>From</th>
        <th>Subject</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>

    @foreach ($sentTrash as $message) 
      <tr onclick="document.location='/messages/{{ $message->id }}'">
        <td>{{ $message->sender->name }}</td>
        <td>{{ $message->subject }}</td>
        <td>{{ $message->prettySent() }}</td>
      </tr>
    @endforeach

  </table>

@endsection