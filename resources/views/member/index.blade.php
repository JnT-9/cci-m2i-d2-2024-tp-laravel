@extends('layouts.app')

@section('title', 'Members')

@section('content')
    <h1>members</h1>

    <div>
        {{ $members->links() }}
    </div>

    <table class="table">
        <tr>
            <th>{{ __("Label") }}</th>
            <th>{{ __("Provider name", [], 'fr') }}</th>
            <th>{{ __("Price HT") }}</th>
            <th>{{ __("Created At") }}</th>
            <th>{{ __("Actions") }}</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->password }}</td>
                <td>{{ $member->created_at }}</td>
                <td>
                    <a class="btn btn-primary d-block m-1" href="{{ route('members.show', $member) }}">{{ __("Show") }}</a>
                    <a class="btn btn-warning d-block m-1" href="{{ route('members.edit', $member) }}">{{ __("Edit") }}</a>
                    <form action="{{ route('members.delete', $member) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger d-block w-100" type="submit">{{ __("Delete") }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div>
        {{ $members->links() }}
    </div>
@endsection
