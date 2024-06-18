<!-- resources/views/admin/users/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.Edit_User') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>{{ __('messages.Edit_User') }}</h1>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('messages.Name') }}</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">{{ __('messages.Email') }}</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.Update') }}</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary back-button">{{ __('messages.Back') }}</a>
        </form>
    </div>
</body>
</html>
                            