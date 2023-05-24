@extends('layout.layout')

@section('title', 'Créer un paiement')

@section('content')

    <div class="container mt-3 mb-5">
        <h1> Créer une dépense</h1>

        <form action="{{ route('spendings.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="type">Type:</label>
                <select name="type" id="type" class="form-control">
                    <option value="other" @if (!request()->has('user_id')) selected @endif>Autre</option>
                    <option value="payment" @if (request()->has('user_id')) selected @endif>Paiement</option>
                </select>
            </div>

            <div class="form-group mb-3" id="userField" @if (!request()->has('user_id')) style="display: none;" @endif>
                <label for="user_id">Utilisateur:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if (request()->has('user_id') && request()->user_id == $user->id) selected @endif>
                            {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="amount">Montant:</label>
                <input type="text" name="amount" id="amount" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>

    </div>


@endsection

@push('scripts')
    <script>
        // Function to toggle the visibility of the "User" select field
        function toggleUserField() {
            var typeSelect = document.getElementById('type');
            var userField = document.getElementById('userField');

            if (typeSelect.value === 'payment') {
                userField.style.display = 'block';
            } else {
                userField.style.display = 'none';
                document.getElementById('user_id').value = null;
            }
        }

        // Attach an event listener to the "Type" select field
        document.getElementById('type').addEventListener('change', toggleUserField);

        // Call the function initially to set the initial visibility state
        toggleUserField();
    </script>
@endpush
