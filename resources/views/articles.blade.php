<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Aggregator</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">News Aggregator</h1>
        <!-- Category Selection Form -->
        <div class="my-4">
            <form id="category-form">
                <div class="form-group">
                    <label for="category">Select Category:</label>
                    <select id="category" class="form-control">
                        <option value="1">Technology</option>
                        <option value="2">Sports</option>
                        <option value="3">Health</option>
                        <option value="4">Business</option>
                        <!-- Add more categories as needed -->
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Show Articles</button>
            </form>
        </div>

        <!-- Articles List -->
        <div id="articles">
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Article Title 1</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">This is a brief summary of the article content.</p>
                    <small class="text-muted">Source: News Source 1</small>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Article Title 2</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">This is a brief summary of the article content.</p>
                    <small class="text-muted">Source: News Source 2</small>
                </div>
            </div>
            <!-- Add more articles as needed -->
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>