<!DOCTYPE html>
<html>
<head>
    <title>Database Tables</title>
</head>
<body style="font-family: Arial; padding: 20px;">

    <h1>Database: {{ $dbName }}</h1>

    @foreach ($tablesData as $table => $columns)
        <h2>Table: {{ $table }}</h2>

        <ul>
            @foreach ($columns as $column)
                <li>{{ $column->Field }}</li>
            @endforeach
        </ul>
    @endforeach

</body>
</html>
